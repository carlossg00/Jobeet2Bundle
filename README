README
======

What is Jobeet2Symfony?
-----------------------

Jobeet2Symfony is the well known day by day tutorial for symfony 1.4 implemented on Symfony2.



Get the code

git clone git://github.com/carlossg00/symfony2-jobeet.git
cd symfony2-jobeet
git submodule init
git submodule update --init --recursive

create a symlink

cd vendor/doctrine-extensions/lib/DoctrineExtensions
ln -s ../../../Doctrine2-Sluggable-Functional-Behaviour/lib/DocrineExtensions/Sluggable/ .

Modify config.yml and build de database

php app/console doctrine:database:create
php app/console doctrine:generate:entities
php app/console doctrine:generate:schema

Load data fixtures

php app/console doctrine:data:load


Make sure the web folder is document root and visit the site:

http://jobeet2/app_dev.php
	or
http://localhost/web/app_dev.php/

The home page doesn't exist yet so to try application:

http://jobeet2/app_dev.php/job/index.html
        or
http://localhost/symfony2-jobbet/web/app_dev.php/job/index.html


MAKE SURE YOUR PHP HAS THE intl and sqlite EXTENSION if you get errors
about a missing Locale class or SQL-lite:

sudo apt-get install php5-intl
apt-get install php5-sqlite



I'm working on it a bit day by day, any contribution will be very welcome.
Hope it will be helpfull!