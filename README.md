# Jobeet2Bundle

Jobeet2Bundle is the well known day by day tutorial for symfony 1.4 ported to Symfony2.

## Installation

### clone repository

	git clone git://github.com/carlossg00/symfony2-jobeet.git src/Application

### Application Kernel

 Add BlogBundle to the 'registerBundles()' method of your application kernel:
 
 	public function registerBundles()
 	{
 		return array(
 		...
 		new Application\Jobeet2Bundle\Jobeet2Bundle(),
 		...
 		);
 	}

### Register namespace
 
 Register the Jobeet2Bundle namespace in autoload
 
 	$loader->registerNamespaces(array(
    	...
    	'Application'					 => __DIR__.'/../src',
    	...
    ));

### Dependencies

SensioFrameworkExtraBundle
	git clone git://github.com/sensio/FrameworkExtraBundle.git src/Sensio/FrameworkExtraBundle
	


### install assets

	app/console install:assets web --symlink


### Build the database
 
 Modify config.yml to your doctrine configuration
 
	## Doctrine Configuration
	doctrine:
   		dbal:
       		dbname:   symfony2-jobeet
       		user:     root
       		password: xxxxxxxx
       		logging:  %kernel.debug%
   		orm:
       		auto_generate_proxy_classes: %kernel.debug%
       		mappings:
           		Jobeet2Bundle: ~

 create the database schema running the following commands
	
	php app/console doctrine:database:create
	php app/console doctrine:generate:entities
	php app/console doctrine:generate:schema 

 Load data fixtures

	php app/console doctrine:data:load


### Try the application

Make sure the web folder is document root and visit the site:

	http://jobeet2/app_dev.php
or
	http://localhost/web/app_dev.php/


## Contributions

Don't ask? just fork it and improve it
Hope it will be helpfull!


## TODO

cd vendor/doctrine-extensions/lib/DoctrineExtensions
ln -s ../../../Doctrine2-Sluggable-Functional-Behaviour/lib/DocrineExtensions/Sluggable/ .


