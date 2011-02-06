#!/bin/sh

DIR=`php -r "echo realpath(dirname(\\$_SERVER['argv'][0]));"`
VENDOR=$DIR/vendor_full

# Symfony
cd $VENDOR/symfony && git fetch origin && git reset --hard origin/master

# Doctrine ORM
cd $VENDOR/doctrine && git fetch origin && git reset --hard 2.0.1

# Doctrine DBAL
cd $VENDOR/doctrine-dbal && git fetch origin && git reset --hard 2.0.1

# Doctrine common
cd $VENDOR/doctrine-common && git fetch origin && git reset --hard 2.0.1

# Doctrine migrations
cd $VENDOR/doctrine-migrations && git fetch origin && git reset --hard origin/master

# Doctrine data fixtures
cd $VENDOR/doctrine-data-fixtures && git fetch origin && git reset --hard origin/master

# Doctrine MongoDB
cd $VENDOR/doctrine-mongodb-odm && git fetch origin && git reset --hard origin/master
cd $VENDOR/doctrine-mongodb && git fetch origin && git reset --hard origin/master

# Swiftmailer
cd $VENDOR/swiftmailer && git fetch origin && git reset --hard origin/4.1

# Twig
cd $VENDOR/twig && git fetch origin && git reset --hard origin/master

# Twig Extensions
cd $VENDOR/twig-extensions && git fetch origin && git reset --hard origin/master

# Zend Framework
cd $VENDOR/zend && git fetch origin && git reset --hard origin/master
git submodule update --recursive --init
