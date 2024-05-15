<?php

require 'vendor/autoload.php';

use AutoNotes\Lib\Doctrine\EntityManagerFactory;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;

$config = new PhpFile('migrations.php');
$dbConfig = include __DIR__ . '/migrations-db.php';

$entityManager = EntityManagerFactory::create($dbConfig);

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));
