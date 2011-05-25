<?php

namespace Application\Jobeet2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Application\Jobeet2Bundle\Entity\User
 * @ORM\Entity
 * @ORM\Table(name="user")
 */

class User
{
    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $name
     * @ORM\Column(type="string",length=255)
     */
    private $name;
   
}
  