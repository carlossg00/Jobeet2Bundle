<?php

namespace Application\Jobeet2Bundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;

class CategoryRepository extends EntityRepository
{
    /**
     * 
     * @return <type>
     */

    public function findOneBySlug($slug)
    {
        return $this->findOneBy(array('slug' => $slug));
    }

    public function getActiveJobs($max = 10)
    {
       $date = new \DateTime('now');

       return $this->_em->createQuery('SELECT j FROM Jobeet2Bundle:Job j
            WHERE
            AND j.expires_at > ?1 ORDER BY j.expires_at DESC')
               ->setParameter(1, $date->format('Y-m-d'))
               ->setMaxResults($max)
               ->getResult();
    }


    public function findAllJobsByCategory()
    {

        $date = new \DateTime('now');        
        return $this->_em->createQuery('SELECT c,j FROM Jobeet2Bundle:Category c
            JOIN c.job j' /*WHERE j.expires_at > ?1'*/)
                //->setParameter(1, $date->format('Y-m-d'))  
                ->getResult();        
    }

    public function findAllIndexedById()
    {
        /*$categoryIndexed = $this->_em->createQuery('SELECT c.name FROM Jobeet2Bundle:Category c INDEX BY c.id')
            ->getResult();
        print_r($categoryIndexed);
        */
        
        // TODO: find how to INDEX BY id
        $categories = $this->_em->getRepository('Jobeet2Bundle:Category')->findAll();

        $categoryIndexed = array();
        foreach ($categories as $category) {
            $categoryIndexed[$category->getId()] = $category->getName();
        }
        
        return $categoryIndexed;
    }
}
