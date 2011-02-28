# Jobeet2Bundle

Jobeet2Bundle is the well known day by day tutorial for symfony 1.4 ported to Symfony2.

## Installation

### clone repository

	git clone git://github.com/carlossg00/symfony2-jobeet.git src/Application/Jobeet2Bundle

### Initializing the bundle
 To start using the bundle, initialize the bundle in your kernel. This file is usually located at app/AppKernel: 

  
 	public function registerBundles()
 	{
 		return array(
 			// ...
	 		new Application\Jobeet2Bundle\Jobeet2Bundle(),
 		
 		);
 	}

### Register namespace
 
 Add the Application namespace to your autoloader
 
 	// app/autoload.php
 	$loader->registerNamespaces(array(
    	// ...
    	'Application'					 => __DIR__.'/../src',    	
    ));

### Dependencies

#### SensioFrameworkExtraBundle (Experimental)
	
	git clone git://github.com/sensio/FrameworkExtraBundle.git src/Sensio/Bundle/FrameworkExtraBundle

 Register bundle in your kernel	
 
	public function registerBundles()
 	{
 		return array(
 			// ...
	 		new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
 		
 		);
 	}
	 
	
#### ZendPaginatorAdapter
	
	git clone git://github.com/ornicar/ZendPaginatorAdapter.git vendor/ZendPaginatorAdapter
	
and register namespace

	// app/autoload.php
 	$loader->registerNamespaces(array(
    	// ...
		'ZendPaginatorAdapter'			 => __DIR__.'/../vendor/ZendPaginatorAdapter/src',
	));
	
#### DoctrineExtensions

	git clone git://github.com/Herzult/DoctrineExtensions.git vendor/DoctrineExtensions

and register namespace

	// app/autoload.php
 	$loader->registerNamespaces(array(
    	// ...
		'DoctrineExtensions'			 => __DIR__.'/../vendor/DoctrineExtensions/lib',
	));


### Install assets

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
           		
 Modify Resources/orm.xml to your connection
 
    <services>
        <!-- Object Manager Service -->
        <service id="jobeet2.object_manager" alias="doctrine.orm.myConnection_entity_manager" />
    </services>   
    
 or default connection if exists only one
    
    <services>
        <!-- Object Manager Service -->
        <service id="jobeet2.object_manager" alias="doctrine.orm.myConnection_entity_manager" />
    </services>

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

## Configuration

 Add following lines to your config.yml to customize your application

## Jobeet2 Configuration
    jobeet2:
        max_jobs_on_homepage :  15
        max_jobs_on_category :  20 
        active_days:            30
 
 or leave as default
 
    jobeet2: ~   

## Contributions

Don't ask, just fork it and enhance it.
Any commit/comments will be welcome!!

Hope it helps!!


## TODO

cd vendor/doctrine-extensions/lib/DoctrineExtensions
ln -s ../../../Doctrine2-Sluggable-Functional-Behaviour/lib/DocrineExtensions/Sluggable/ .


