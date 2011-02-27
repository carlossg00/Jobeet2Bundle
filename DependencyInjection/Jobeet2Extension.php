<?php

namespace Application\Jobeet2Bundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;


class Jobeet2Extension extends Extension
{
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        
        $loader->load('config.xml');
    
        foreach($config as $key => $value) {        
            $container->setParameter('jobeet2.'.$key, $value);
        }
        
        $loader->load('controller.xml');       
    }

    public function getXsdValidationBasePath()
    {
        return null;
        //return __DIR__.'/../Resources/config/';
    }

    public function getNamespace()
    {
        return 'http://www.symfony-project.org/schema/dic/symfony';
    }

    public function getAlias()
    {
        return 'jobeet2';
    }
}