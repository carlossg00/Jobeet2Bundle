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


class JobController extends ContainerAware
{
	
	private $request;
    private $repository;
    private $router;
    private $templating;
	
	/**
     * Post Constructor.
     * Called from DIC after setContainer method
     * assign values to member variables for better code readability 
     */
   
    public function __postConstruct()
    {
    	$this->request = $this->container->get('request');        
        $this->router = $this->container->get('router');
        $this->repository = $this->container->get('jobeet2.job.repository');
        $this->templating = $this->container->get('templating');
    }
	        
    /**
     * 
     * List jobs by Category in homepage
     * @param Category $category
     * @param string $context
     * @param integer $page
     */
    
    public function listAction(Category $category = null, $max = 10)
    {
    	 	
        if (null !== $category) {            
            $jobs = $this->repository->getActiveJobsByCategory($category, $max);            
        } else {
            $jobs = $this->repository->findAll(true);
        }
        
        return $this->templating->renderResponse('Jobeet2Bundle:Job:list.html.twig', array(
            'jobs'      => $jobs,
            'category'  => $category,           
        ));
        
    }
    
    /**
     * Show deatiled job info
     * @param: slug
     */

    public function showAction($id)
    {

        $job = $this->repository->findOneById($id);
        
        if (!$job) {
            throw new NotFoundHttpException('The Job does not exist.');
        }
        return $this->templating->renderResponse('Jobeet2Bundle:Job:show.html.twig',
            array('job'=>$job));
        
    }
   


    //TODO Refactor
    public function newAction()
    {

        /*return $this->templating->renderResponse('Jobeet2:Job:new.html.twig',
                array('form'=>$form));*/
        
    }


    public function deleteAction($id)
    {
        $em = $this->getEm();
        $job = $em->find("Jobeet2Bundle:Job",$id);

         if (!$this->job) {
            throw new NotFoundHttpException('The Job does not exist.');
        }

        $em->remove($job);
        $em->flush();

        return new RedirectResponse($this->router->generate('index'));

    }

    public function editAction($id)
    {
               
    }
}
