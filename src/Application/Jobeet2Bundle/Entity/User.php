<?php

namespace Application\Jobeet2Bundle\Entity;

/**
 * Application\Jobeet2Bundle\Entity\User
 * @orm:Entity
 * @orm:Table(name="user")
 */

class User
{
    /**
     * @var integer $id
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $name
     * @orm:Column(type="string",length=255)
     */
    private $name;
   
}
  