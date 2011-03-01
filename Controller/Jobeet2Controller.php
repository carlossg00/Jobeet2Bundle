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
	
	/**
     * Constructor.
     *
     * @param Request               $request     
     * @param UrlGeneratorInterface $router
     * @param EntityRepository		$repository
     * @param EngineInterface       $templating
     */
    public function __construct(Request $request, EntityRepository $repository, UrlGeneratorInterface $router, EngineInterface $templating)
    {
        $this->request = $request;        
        $this->router = $router;
        $this->repository = $repository;
        $this->templating = $templating;        
    }
	    

    public function indexAction()
    {

        $categories = $this->repository->getWithJobs();
       
        return $this->templating->renderResponse('Jobeet2Bundle::index.html.twig',
                array('categories'=>$categories,
                	  'nJobsPage' =>$this->container->getParameter('jobeet2.max_jobs_on_homepage'),
                	));

    }    
}
