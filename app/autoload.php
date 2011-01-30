<?php

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'                        => __DIR__.'/../src/vendor/symfony/src',
    'Application'                    => __DIR__.'/../src',
    'Bundle'                         => __DIR__.'/../src',
    'Doctrine\\Common\\DataFixtures' => __DIR__.'/../src/vendor/doctrine-data-fixtures/lib',
    'Doctrine\\Common'               => __DIR__.'/../src/vendor/doctrine-common/lib',
    'Doctrine\\DBAL\\Migrations'     => __DIR__.'/../src/vendor/doctrine-migrations/lib',
    'Doctrine\\MongoDB'              => __DIR__.'/../src/vendor/doctrine-mongodb/lib',
    'Doctrine\\ODM\\MongoDB'         => __DIR__.'/../src/vendor/doctrine-mongodb-odm/lib',
    'Doctrine\\DBAL'                 => __DIR__.'/../src/vendor/doctrine-dbal/lib',
    'Doctrine'                       => __DIR__.'/../src/vendor/doctrine/lib',
    'Zend'                           => __DIR__.'/../src/vendor/zend/library',
));
$loader->registerPrefixes(array(
    'Twig_Extensions_' => __DIR__.'/../src/vendor/twig-extensions/lib',
    'Twig_'            => __DIR__.'/../src/vendor/twig/lib',
    'Swift_'           => __DIR__.'/../src/vendor/swiftmailer/lib/classes',
));
$loader->register();
