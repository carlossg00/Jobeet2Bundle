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
    
### Add a reference to the routes in app/config/routing.yml

    _job:
        resource: "@Jobeet2Bundle/Resources/config/routing.yml"
        prefix: /job
    

### Dependencies

 - [SensioFrameworkExtraBundle](http://github.com/sensio/FrameworkExtraBundle/)	<-NOT USED RIGHT NOW
 	
 - [PaginatorBundle](http://github.com/knplabs/PaginatorBundle/)

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
 if multiple connections
 
    <services>
        <!-- Object Manager Service -->
        <service id="jobeet2.object_manager" alias="doctrine.orm.myConnection_entity_manager" />
    </services>   
    
 or default connection if only one
    
    <services>
        <!-- Object Manager Service -->
        <service id="jobeet2.object_manager" alias="doctrine.orm.default_entity_manager" />
    </services>

 create the database schema running the following commands
	
	php app/console doctrine:database:create	
	php app/console doctrine:schema:create 

 Load data fixtures

	php app/console doctrine:data:load


### Try the application

Make sure the web folder is document root and visit the site:

	http://jobeet2/app_dev.php/job
 or
    http://localhost/web/app_dev.php/job

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

