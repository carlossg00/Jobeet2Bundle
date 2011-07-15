<?php

namespace Application\Jobeet2Bundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Zend\Paginator\Paginator;


class CategoryController extends Controller
{
    
    /**
     * @Route("/{slug}", name="_category_job_show")
     */

    public function showAction($slug)
    {      
        $em = $this->get('doctrine')->getEntityManager();
        $repository = $em->getRepository('Jobeet2Bundle:Category');

        $category = $repository->findOneBySlug($slug);
               
        if (!$category) {
            throw new NotFoundHttpException('The Category does not exist.');
        }
        
        $page = $this->getRequest()->query->get('page', 1);
        
        
        $adapter = $this->get('knp_paginator.adapter');
		$adapter->setQuery($repository->getActiveJobsByCategoryQuery($category));
		$adapter->setDistinct(true);	
        
        $jobs = new Paginator($adapter);        
        $jobs->setCurrentPageNumber($page);
        $jobs->setItemCountPerPage($this->container->getParameter('jobeet2.max_jobs_on_category'));
        $jobs->setPageRange(5);
          
        return $this->render('Jobeet2Bundle:Category:show.html.twig',
            array('category'    => $category,
                  'jobs'        => $jobs));
        
    }
}
