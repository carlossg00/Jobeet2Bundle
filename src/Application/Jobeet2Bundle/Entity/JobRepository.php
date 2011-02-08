<?php

namespace Application\Jobeet2Bundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Zend\Paginator\Paginator;
use ZendPaginatorAdapter\DoctrineORMAdapter;

class JobRepository extends EntityRepository
{
    
    public function findOneBySlug($slug)
    {
        return $this->findOneBy(array('slug' => $slug));
    }
    
    public function findAllByCategory($category, $asPaginator = false)
    {        
        $qb = $this->createQueryBuilder('job')            
                ->where('job.category = ?1')
                ->setParameter(1, $category);              
        
        
        if ($asPaginator) {
            return new Paginator(new DoctrineORMAdapter($qb->getQuery()));
        } else {
            return $qb->getQuery()->execute();
        }       
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