<?php

require 'vendor/autoload.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\DBAL\DriverManager;

$config = new PhpFile('migrations.php');

$paths = [__DIR__ . '/Entities'];

$dbConfig = include __DIR__ . '/migrations-db.php';

$ORMConfig = ORMSetup::createAttributeMetadataConfiguration($paths, true);
$connection = DriverManager::getConnection($dbConfig);

$entityManager = new EntityManager($connection, $ORMConfig);

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));
