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
	
	/**
     * Constructor.
     *
     * @param Request               $request
     * @param EntityRepository    $repository
     * @param UrlGeneratorInterface $router
     * @param EngineInterface       $templating
     */
    
    public function __construct(Request $request, EntityRepository $repository, UrlGeneratorInterface $router, EngineInterface $templating)
    {
        $this->request = $request;
        $this->repository = $repository;
        $this->router = $router;
        $this->templating = $templating;
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
		//TODO Bug when setDistinct(true)
		
        
        $jobs = new Paginator($adapter);        
        $jobs->setCurrentPageNumber($page);
        $jobs->setItemCountPerPage($this->container->getParameter('jobeet2.max_jobs_on_category'));        
        $jobs->setPageRange(5);
          
        return $this->templating->renderResponse('Jobeet2:Category:show.html.twig',
            array('category'    => $category,
                  'jobs'        => $jobs));
        
    }
}
