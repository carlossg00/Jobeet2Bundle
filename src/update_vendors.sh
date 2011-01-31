#!/bin/sh

DIR=`php -r "echo realpath(dirname(\\$_SERVER['argv'][0]));"`
VENDOR=$DIR/vendor_full

# Symfony
cd $VENDOR/symfony && git pull

# Doctrine ORM
cd $VENDOR/doctrine
git checkout master
git pull
git checkout -b v2.0.1 2.0.1

# Doctrine DBAL
cd $VENDOR/doctrine-dbal
git checkout master
git pull
git checkout -b v2.0.1 2.0.1

# Doctrine common
cd $VENDOR/doctrine-common
git checkout master
git pull
git checkout -b v2.0.1 2.0.1

# Doctrine migrations
cd $VENDOR/doctrine-migrations && git pull

# Doctrine data fixtures
cd $VENDOR/doctrine-data-fixtures && git pull

# Doctrine MongoDB
cd $VENDOR/doctrine-mongodb-odm
git checkout master
git pull
#git checkout -b v1.0.0BETA1 1.0.0BETA1

cd $VENDOR/doctrine-mongodb
git checkout master
git pull

# Swiftmailer
cd $VENDOR/swiftmailer && git pull
git checkout -b 4.1 origin/4.1

# Twig
cd $VENDOR/twig && git pull

# Twig Extensions
cd $VENDOR/twig-extensions && git pull

# Zend Framework
cd $VENDOR/zend && git pull
git submodule update --recursive --init
