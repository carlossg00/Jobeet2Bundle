<?php

namespace Application\Jobeet2Bundle\Entity;

//use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class JobRepository extends EntityRepository
{
    
    public function findAllByCategory(Category $category)
    {
        return $this->_em->createQuery('SELECT j FROM Jobeet2Bundle:Job j
                                 WHERE j.category = ?1')
                    ->setParameter(1, $category)
                    ->setMaxResults(10)
                    ->getResult();
        
    }
    
    public function getActiveJobs($max = 10)
    {
       $date = new \DateTime('now');
     
       return $this->_em->createQuery('SELECT j FROM Jobeet2Bundle:Job j
            WHERE j.expires_at > ?1 ORDER BY j.expires_at DESC')
               ->setParameter(1, $date->format('Y-m-d'))
               ->setMaxResults($max)
               ->getResult();
    }    
}