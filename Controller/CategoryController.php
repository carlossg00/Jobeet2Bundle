<?php

namespace Application\Jobeet2Bundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use Zend\Paginator\Paginator;

class CategoryController extends ContainerAware
{
	private $request;
    private $repository;
    private $router;
    private $templating;
    private $max_jobs_on_homepage;
	
	/**
     * Post Constructor.
     * Called from DIC after setContainer method
     * assign values to member variables for better code readability 
     */
   
    public function __postConstruct()
    {
    	$this->request = $this->container->get('request');        
        $this->router = $this->container->get('router');
        $this->repository = $this->container->get('jobeet2.category.repository');
        $this->templating = $this->container->get('templating');
        $this->max_jobs_on_category = $this->container->getParameter('jobeet2.max_jobs_on_category');
    }    
    
    /**
     * 
     * Show Jobs in category
     * @param string $slug
     */
    
    public function showAction($slug)
    {      
        
        $category = $this->repository->findOneBySlug($slug);
               
        if (!$category) {
            throw new NotFoundHttpException('The Category does not exist.');
        }
        
        $page = $this->request->query->get('page', 1);
        
        
        
        $adapter = $this->container->get('knplabs_paginator.adapter');
		$adapter->setQuery($this->repository->getActiveJobsByCategoryQuery($category));
		$adapter->setDistinct(true);	
        
        $jobs = new Paginator($adapter);        
        $jobs->setCurrentPageNumber($page);
        $jobs->setItemCountPerPage($this->max_jobs_on_category);        
        $jobs->setPageRange(5);
          
        return $this->templating->renderResponse('Jobeet2:Category:show.html.twig',
            array('category'    => $category,
                  'jobs'        => $jobs));
        
    }
}
