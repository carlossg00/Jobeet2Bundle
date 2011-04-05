<?php


namespace Application\Jobeet2Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class contains the configuration information for the bundle
 */

class Configuration //extends ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return \Symfony\Component\Config\Definition\NodeInterface
     */
    public function getConfigTree()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('jobeet2', 'array');

        $rootNode
        	->children()
            	->scalarNode('max_jobs_on_homepage')->defaultValue('10')->end()
            	->scalarNode('active_days')->defaultValue('30')->end()
            	->scalarNode('max_jobs_on_category')->defaultValue('20')->end()           
            ->end();          
            
        return $treeBuilder->buildTree();
    }
}
