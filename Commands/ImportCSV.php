<?php

namespace AutoNotes\Commands;

use AutoNotes\Entities\Car;
use AutoNotes\Entities\Currency;
use AutoNotes\Entities\Expense;
use AutoNotes\Entities\FillingStation;
use AutoNotes\Entities\Fuel;
use AutoNotes\Entities\Mileage;
use AutoNotes\Entities\Order;
use AutoNotes\Entities\OrderType;
use AutoNotes\Entities\Service;
use AutoNotes\Entities\User;
use DateTime;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:csv')]
class ImportCSV extends Command
{
    private EntityManager $em;

    private static $uah;
    private static $rub;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;

        self::$uah = $this->em->getReference(Currency::class, 1);
        self::$rub = $this->em->getReference(Currency::class, 2);

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Import CSV files')
            ->setHelp('Import data from CSV files')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->importFuels();
        $this->importMileages($output);
        $this->importExpenses($output);
        $this->importServices($output);
        $this->importOrderTypes($output);
        $this->importOrders($output);

        return Command::SUCCESS;
    }

    protected function importFuels(): void
    {
        $fp = fopen(realpath(__DIR__ . '/../dumps') . '/ab_fuel.csv', 'r');
        $fuels = [];
        while (($data = fgetcsv($fp)) !== false) {
            $fuels[] = $data;
        }
        fclose($fp);

        $nissan = $this->em->getReference(Car::class, 1);
        $pajero = $this->em->getReference(Car::class, 2);

        foreach ($fuels as $fuelData) {
            $date = DateTime::createFromFormat('d.m.Y', $fuelData[0]);

            $value = (float)$fuelData[1];
            $cost = (float)$fuelData[3];
            $currency = $this->getCurrency($date);
            $car = $pajero;
            if (!empty($fuelData[4]) && $fuelData[4] == 'n') {
                $car = $nissan;
            }

            $azsId = $this->getFillingStationId(trim($fuelData[2]));
            $azs = $this->em->getReference(FillingStation::class, $azsId);

            $fuel = new Fuel();
            $fuel
                ->setDate($date)
                ->setCar($car)
                ->setStation($azs)
                ->setValue($value)
                ->setCost($cost)
                ->setCurrency($currency)
            ;

            $this->em->persist($fuel);
            $this->em->flush();
        }
    }

    protected function importMileages(OutputInterface $output): void
    {
        $ages = $this->mileagesFromFile('ab_fuel.csv', 0, 5);
        $ages = array_merge($ages, $this->mileagesFromFile('ab_rash.csv', 5, 4));
        $ages = array_merge($ages, $this->mileagesFromFile('ab_work.csv', 0, 3));

        $filtered = [];
        $usedKeys = [];
        foreach ($ages as $item) {
            $key = $item['date']->format('Ymd') . '-' . $item['distanse'];
            if (!isset($usedKeys[$key])) {
                $filtered[] = $item;
                $usedKeys[$key] = true;
            }
        }

        usort($filtered, [$this, 'sortByDate']);

        $nissan = $this->em->getReference(Car::class, 1);
        $pajero = $this->em->getReference(Car::class, 2);

        foreach ($filtered as $item) {
            $car = $pajero;
            if ($item['distanse'] > 300000) {
                $car = $nissan;
            }

            $mileage = new Mileage();
            $mileage
                ->setCar($car)
                ->setDate($item['date'])
                ->setDistance($item['distanse'])
            ;

            $this->em->persist($mileage);
            $this->em->flush();
        }

        $output->writeln(sprintf('Imported %d items', count($filtered)));
    }

    protected function importExpenses(OutputInterface $output): void
    {
        $expenses = array_merge([], $this->expensesFromFile('ab_garage.csv', 0, 2, 1));
        $expenses = array_map(function (array $a) {
            $a['type'] = Expense::TYPE_GARAGE;

            return $a;
        }, $expenses);

        $tools = $this->expensesFromFile('ab_tools.csv', 0, 2, 1);
        $tools = array_map(function (array $a) {
            $a['type'] = Expense::TYPE_TOOLS;

            return $a;
        }, $tools);
        $expenses = array_merge($expenses, $tools);

        $works = $this->expensesFromFile('ab_work.csv', 0, 2, 1);
        $works = array_filter($works, function (array $a) {
            return $a['description'] == 'мойка';
        });
        $works = array_map(function (array $a) {
            $a['type'] = Expense::TYPE_WASHING;

            return $a;
        }, $works);
        $expenses = array_merge($expenses, $works);

        usort($expenses, [$this, 'sortByDate']);

        $user = $this->em->getReference(User::class, 1);
        foreach ($expenses as $item) {
            $expense = new Expense();
            $expense
                ->setDate($item['date'])
                ->setCost($item['cost'])
                ->setDescription($item['description'])
                ->setCurrency($this->getCurrency($item['date']))
                ->setType($item['type'])
                ->setUser($user)
            ;

            $this->em->persist($expense);
            $this->em->flush();
        }

        $output->writeln(sprintf('Imported %d items', count($expenses)));
    }

    protected function importServices(OutputInterface $output): void
    {
        $items = [];
        $fp = fopen(realpath(__DIR__ . '/../dumps') . '/ab_work.csv', 'r');
        while (($data = fgetcsv($fp)) !== false) {
            $date = DateTime::createFromFormat('d.m.Y', $data[0]);

            $items[] = [
                'date' => $date,
                'cost' => (float)$data[2],
                'description' => $data[1],
                'distanse' => (int)$data[3],
            ];
        }
        fclose($fp);

        $items = array_filter($items, function (array $a) {
            return $a['description'] != 'мойка';
        });

        $nissan = $this->em->getReference(Car::class, 1);
        $pajero = $this->em->getReference(Car::class, 2);

        foreach ($items as $item) {
            $car = $pajero;
            if ($item['distanse'] > 300000) {
                $car = $nissan;
            }

            $service = new Service();
            $service
                ->setDate($item['date'])
                ->setCar($car)
                ->setDescription($item['description'])
            ;

            if ($item['cost'] > 0) {
                $service
                    ->setCost($item['cost'])
                    ->setCurrency($this->getCurrency($item['date']))
                ;
            }

            if ($item['distanse'] > 0) {
                $mileage = $this->em->getRepository(Mileage::class)->findOneBy([
                    'date' => $item['date'],
                    'distanse' => $item['distanse'],
                ]);
                if ($mileage) {
                    $service->setMileage($mileage);
                }
            }

            $this->em->persist($service);
            $this->em->flush();
        }

        $output->writeln(sprintf('Imported %d items', count($items)));
    }

    protected function importOrderTypes(OutputInterface $output)
    {
        $items = [];
        $fp = fopen(realpath(__DIR__ . '/../dumps') . '/ab_rash.csv', 'r');
        while (($data = fgetcsv($fp)) !== false) {
            if ($data[1]) {
                $items[] = $data[1];
            }
        }
        fclose($fp);

        $items = array_unique($items);

        foreach ($items as $item) {
            $type = new OrderType();
            $type->setName($item);

            $this->em->persist($type);
            $this->em->flush();
        }

        $output->writeln(sprintf('Imported %d items', count($items)));
    }

    protected function importOrders(OutputInterface $output)
    {
        $items = [];
        $fp = fopen(realpath(__DIR__ . '/../dumps') . '/ab_rash.csv', 'r');
        while (($data = fgetcsv($fp)) !== false) {
            $items[] = [
                'date' => DateTime::createFromFormat('d.m.Y', $data[0]),
                'type' => $data[1],
                'cost' => (float)$data[2],
                'description' => $data[3],
                'distanse' => (int)$data[4],
                'usedAt' => $data[5] ? DateTime::createFromFormat('d.m.Y', $data[5]) : null,
                'capacity' => $data[6] ?: null,
            ];
        }
        fclose($fp);

        $user = $this->em->getReference(User::class, 1);

        foreach ($items as $item) {
            $order = new Order();
            $order
                ->setDate($item['date'])
                ->setDescription($item['description'])
                ->setUser($user)
                ->setCapacity($item['capacity'])
                ->setCost($item['cost'])
                    ->setCurrency($this->getCurrency($item['date']))
            ;

            if ($item['type']) {
                $type = $this->em->getRepository(OrderType::class)->findOneBy(['name' => $item['type']]);
                if ($type) {
                    $order->setType($type);
                }
            }

            if ($item['distanse'] > 0) {
                $mileage = $this->em->getRepository(Mileage::class)->findOneBy([
                    'distanse' => $item['distanse'],
                ]);
                if ($mileage) {
                    $order->setMileage($mileage);
                }
            }

            if ($item['usedAt']) {
                $order->setUsedAt($item['usedAt']);
            }

            $this->em->persist($order);
            $this->em->flush();
        }

        $output->writeln(sprintf('Imported %d items', count($items)));
    }

    protected function mileagesFromFile(string $filename, int $dateIdx, int $distanseIdx): array
    {
        $items = [];
        $fp = fopen(realpath(__DIR__ . '/../dumps') . '/' . $filename, 'r');
        while (($data = fgetcsv($fp)) !== false) {
            if (!empty($data[$distanseIdx]) && !empty($data[$dateIdx])) {
                $date = DateTime::createFromFormat('d.m.Y', $data[$dateIdx]);

                $items[] = [
                    'date' => $date,
                    'distanse' => (int)$data[$distanseIdx],
                ];
            }
        }
        fclose($fp);

        return $items;
    }

    protected function expensesFromFile(string $filename, int $dateIdx, int $costIdx, int $descriptionIdx): array
    {
        $items = [];
        $fp = fopen(realpath(__DIR__ . '/../dumps') . '/' . $filename, 'r');
        while (($data = fgetcsv($fp)) !== false) {
            if (!empty($data[$dateIdx]) && !empty($data[$costIdx])) {
                $date = DateTime::createFromFormat('d.m.Y', $data[$dateIdx]);

                $items[] = [
                    'date' => $date,
                    'cost' => (float)$data[$costIdx],
                    'description' => $data[$descriptionIdx],
                ];
            }
        }
        fclose($fp);

        return $items;
    }

    protected function getCurrency(DateTime $date)
    {
        // 1659362247 -> UNIX timestamp 2022-08-01
        if ((int)$date->format('U') > 1659362247) {
            $curr = self::$rub;
        } else {
            $curr = self::$uah;
        }

        return $curr;
    }

    protected function getFillingStationId(string $name): int
    {
        switch ($name) {
            case 'shell':
            case 'shell v-power':
                $id = 1;
                break;
            case 'ovis':
            case 'ovis orlen':
                $id = 4;
                break;
            case 'upg':
                $id = 5;
                break;
            case 'wog':
                $id = 6;
                break;
            case 'okko':
                $id = 2;
                break;
            case 'xado':
                $id = 3;
                break;
            case 'marshal':
                $id = 7;
                break;
            case 'ukrnafta':
                $id = 8;
                break;
            case 'Atan':
                $id = 9;
                break;
            case 'Red Petrol':
                $id = 10;
                break;
            case 'Formula':
                $id = 11;
                break;
            case 'АМК':
                $id = 14;
                break;
            case 'TATneft':
                $id = 12;
                break;
            case 'TES':
                $id = 13;
                break;
            default:
                $id = 0;
        }

        return $id;
    }

    protected function sortByDate(array $a, array $b)
    {
        $au = (int)$a['date']->format('Ymd');
        $bu = (int)$b['date']->format('Ymd');

        if ($au == $bu) {
            return 0;
        }

        return $au < $bu ? -1 : 1;
    }
}
