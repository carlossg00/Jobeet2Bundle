<?php

namespace Application\Jobeet2Bundle\Entity;

//use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class JobRepository extends EntityRepository
{
    public function getActiveJobs()
    {
       $date = new \DateTime('now');
       return $this->_em->createQuery('SELECT j FROM Jobeet2Bundle:Job j
            WHERE j.expires_at > ?1 ORDER BY j.expires_at DESC')
               ->setParameter(1, $date->format('Y-m-d'))
               ->getResult();
    }    
}