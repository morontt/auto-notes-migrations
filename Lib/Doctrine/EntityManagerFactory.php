<?php

namespace AutoNotes\Lib\Doctrine;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Doctrine\ORM\ORMSetup;

class EntityManagerFactory
{
    public static function create(array $config): EntityManager
    {
        $paths = [realpath(__DIR__ . '/../../Entities')];

        $ORMConfig = ORMSetup::createConfiguration(true);
        $ORMConfig->setMetadataDriverImpl(new AttributeDriver($paths));
        $ORMConfig->setNamingStrategy(new PluralUnderscoreNamingStrategy());

        $connection = DriverManager::getConnection($config);

        return new EntityManager($connection, $ORMConfig);
    }
}
