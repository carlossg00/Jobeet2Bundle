<?php

namespace Application\Jobeet2Bundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;
   

class Jobeet2Extension extends Extension
{
	 /**
     * Loads the Jobeet2 configuration.
     *
     * Usage example:
     *
     *      <jobeet2:config>
     *        <jobeet2:max_jobs_on_homepage>10</jobeet2:max_jobs_on_homepage>
     *        <jobeet2:active_days>10</jobeet2:active_days>
     *      </jobeet2:config>
     *
     * @param array            $config    An array of configuration settings
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
	
    public function load(array $configs, ContainerBuilder $container)
    {
    	    	
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
                
        $loader->load('config.xml');
        
        $configuration = new Configuration();
        $processor = new Processor();
        $config = $processor->process($configuration->getConfigTree(), $configs);

        foreach ($config as $k => $v)
        {
        	$container->setParameter('jobeet2.'.$k, $v);
        }        
        
      //  $loader->load('model.xml');
      //  $loader->load('controller.xml');
 //       $loader->load('form.xml');
    }


    public function getAlias()
    {
        return 'jobeet2';
    }   
}