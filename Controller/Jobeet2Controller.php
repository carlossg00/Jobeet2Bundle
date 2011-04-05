<?php

namespace Application\Jobeet2Bundle\Controller;

use Application\Jobeet2Bundle\Entity\Job;
use Application\Jobeet2Bundle\Entity\User;
use Application\Jobeet2Bundle\Entity\Category;
use Application\Jobeet2Bundle\Form\JobForm;

use Symfony\Component\DependencyInjection\ContainerAware;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class Jobeet2Controller extends ContainerAware
{
	
	private $request;    
    private $router;
    private $templating;
    private $repository;
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
        $this->max_jobs_on_homepage = $this->container->getParameter('jobeet2.max_jobs_on_homepage'); 
    }	    

    public function indexAction()
    {

    	
    	$categories = $this->repository->getWithJobs(); 	   	 
       
        return $this->templating->renderResponse('Jobeet2Bundle::index.html.twig',
                array('categories'=>$categories,
                	  'nJobsPage' =>$this->max_jobs_on_homepage,
                	));

    }    
}
