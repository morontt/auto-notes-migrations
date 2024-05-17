<?php

namespace AutoNotes\Commands;

use AutoNotes\Entities\Car;
use AutoNotes\Entities\Currency;
use AutoNotes\Entities\FillingStation;
use AutoNotes\Entities\Fuel;
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

        return Command::SUCCESS;
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
}
