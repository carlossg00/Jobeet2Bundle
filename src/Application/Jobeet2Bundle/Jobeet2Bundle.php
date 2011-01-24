<?php

namespace Application\Jobeet2Bundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class Jobeet2Bundle extends Bundle
{
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
