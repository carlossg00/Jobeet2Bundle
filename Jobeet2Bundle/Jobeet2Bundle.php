<?php

namespace Application\Jobeet2Bundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Doctrine\ORM\Events;
use DoctrineExtensions\Sluggable\SluggableListener;

class Jobeet2Bundle extends Bundle
{
     
     public function boot()
     {
        $evm = $this->container->get('doctrine.orm.entity_manager')->getEventManager();
        
        $evm->addEventListener(array(Events::prePersist, Events::preRemove),
                                 new SluggableListener($evm));        


     } 
    
     /**
     * {@inheritdoc}
     */
     public function getNamespace()
     {
          return __NAMESPACE__;
     }

    /**
     * {@inheritdoc}
     */
     public function getPath()
     {
          return strtr(__DIR__, '\\', '/');
     }
    
}
