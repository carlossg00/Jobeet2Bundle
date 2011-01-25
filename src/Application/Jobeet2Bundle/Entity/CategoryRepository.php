<?php

namespace Application\Jobeet2Bundle\Entity;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    /**
     * 
     * @return <type>
     */

    public function findAllJobsByCategory()
    {

        $date = new \DateTime('now');
        //$limit = $this->container->getParameter('jobeet2.max_jobs_on_homepage');
        return $this->_em->createQuery('SELECT c,j FROM Jobeet2Bundle:Category c
            LEFT JOIN c.job j' /*WHERE j.expires_at > ?1'*/)
                //->setParameter(1, $date->format('Y-m-d'))
                ->setMaxResults(10)
                ->getResult();        
    }

    public function findAllIndexedById()
    {
        // TODO: find how to INDEX BY id
        $categories = $this->_em->getRepository('Jobeet2Bundle:Category')->findAll();

        $categoryIndexed = array();
        foreach ($categories as $category) {
            $categoryIndexed[$category->getId()] = $category->getName();
        }

        return $categoryIndexed;
    }
}
