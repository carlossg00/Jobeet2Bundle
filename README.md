# Jobeet2Bundle

Jobeet2Bundle is the well known day by day tutorial for symfony 1.4 ported to Symfony2.

## Installation

Jobeet2Bundle is mantained to be installed with the latest symfony-standard version (at this time RC3)

### clone repository

	git clone git://github.com/carlossg00/Jobeet2Bundle.git src/Application/Jobeet2Bundle

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
    
### Add the following routes to your global routing file (app/config/routing.yml or app/config/routing_dev.yml)

    _jobeet:
        resource: "@Jobeet2Bundle/Controller/Jobeet2Controller.php"
        type:   annotation
        prefix: /jobeet

    _job:
        resource: "@Jobeet2Bundle/Controller/JobController.php"
        type:   annotation
        prefix: /job

    _category:
        resource: "@Jobeet2Bundle/Controller/CategoryController.php"
        type:   annotation
        prefix: /category
    

### Dependencies

Jobeet2Bundle uses:

  - [PaginatorBundle](http://github.com/knplabs/KnpPaginatorBundle) <<-- needs Zend (see KnpPaginatorBundle readme)

### Install assets

	app/console assets:install web --symlink


### Build the database
 
 In SE modify parameters.ini to your database settings

 You can set them manually in config.yml
 
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
	php app/console doctrine:schema:create 

 Load data fixtures

	php app/console doctrine:fixtures:load


### Try the application

Make sure the web folder is document root and visit the site:

	http://jobeet2/app_dev.php/jobeet
 or
    http://localhost/web/app_dev.php/jobeet

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

