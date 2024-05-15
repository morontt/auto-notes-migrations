<?php

namespace AutoNotes\Lib\Doctrine;

use Doctrine\Inflector\InflectorFactory;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;

class PluralUnderscoreNamingStrategy extends UnderscoreNamingStrategy
{
    /**
     * {@inheritdoc}
     */
    public function classToTableName($className): string
    {
        $matches = [];
        if (preg_match('/(.*)([A-Z][^A-Z]+)$/', $className, $matches)) {
            $inflector = InflectorFactory::create()->build();
            $className = $matches[1] . $inflector->pluralize($matches[2]);
        }

        return parent::classToTableName($className);
    }
}
