<?php

namespace Application\Jobeet2Bundle\Entity;

use Application\Jobeet2Bundle\Entity\Category;
use Doctrine\ORM\EntityRepository;



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
    
    /**
     * Fetch categories with jobs in it
     * @return categories
     */
    
    public function getWithJobs()
    {
    	$qb = $this->createQueryBuilder('c')
    		->innerJoin('c.job','j');
    		
    	//TODO ActiveJobs
        return $this->_em->getRepository('Jobeet2Bundle:Job')->addActiveJobsQuery($qb)
                ->getResult();
        
    	//return $qb->getQuery()->getResult();
    	
    }
    
    /**
     * NumEnter description here ...
     * @param Category $category
     * @return QueryBuilder
     */
    
    public function getActiveJobsByCategoryQuery(Category $category)
    {
    	return $this->_em->getRepository('Jobeet2Bundle:Job')->getActiveJobsByCategoryQuery($category);    	
    }
        
    /**
     * 
     * Number of active jobs by category
     * @param	Category $category
     * @return  integer
     */
    
    public function countActiveByCategoryJobs(Category $category)    
    {
    	$this->getActiveJobsByCategoryQuery($category)->count()->getSingleScalarResult();
    }
    
    /**
     * Fetch jobs by categories
     * @param unknown_type $category
     * @return Categories
     */
    
    public function getActiveJobsByCategory(Category $category)
    {
    	$this->getActiveJobsByCategoryQuery($category)->getResult();
    }
        
}
