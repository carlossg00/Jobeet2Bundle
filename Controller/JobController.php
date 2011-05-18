<?php

namespace Application\Jobeet2Bundle\Controller;

use Application\Jobeet2Bundle\Entity\Job;
use Application\Jobeet2Bundle\Entity\User;
use Application\Jobeet2Bundle\Entity\Category;
use Application\Jobeet2Bundle\Form\JobType;

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
    private $em;
	
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
        $this->em = $this->container->get('jobeet2.object_manager');
        $this->active_days = $this->container->getParameter('jobeet2.active_days');
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
     * @param: id
     */

    public function showAction($id)
    {

        $job = $this->repository->findOneById($id);
        
        if (!$job) {
            throw new NotFoundHttpException('The Job does not exist.');
        }
        return $this->templating->renderResponse('Jobeet2Bundle:Job:show.html.twig',
            array('job'=>$job,
                 'active_days' => $this->active_days));
        
    }



    public function deleteAction($id)
    {

        $this->container->get('session')->setFlash('notice', 'Your changes were saved!');

        $job = $this->repository->findOneById($id);

        if (!$job) {
            throw new NotFoundHttpException('The Job does not exist.');
        }

        $this->em->remove($job);
        $this->em->flush();

        return new RedirectResponse($this->router->generate('homepage'));

        /*$httpKernel = $this->container->get('http_kernel');
        return $httpKernel->forward('job.controller:listAction');*/

    }

    public function editAction($id = null)
    {
        if (isset($id)) {
            $job = $this->repository->findOneById($id);

            if (!$job) {
                throw new NotFoundHttpException('The Job does not exist.');
            }

        } else {
            $job = new Job();
        }

        $form = $this->container->get('form.factory')->create(new JobType($this->em),$job);

         if ($this->request->getMethod() == 'POST') {

            $form->bindRequest($this->request);

            if ($form->isValid()) {
                $this->em->persist($job);
                $this->em->flush();

                $httpKernel = $this->container->get('http_kernel');
                return $httpKernel->forward('job.controller:showAction', array(
                                                'id'  => $job->getID()
                    ));
            }
         }

        return $this->templating->renderResponse('Jobeet2Bundle:Job:create.html.twig',
        		array('form' => $form->createView(),
        		));
    }

    public function publishAction($id)
    {
        $job = $this->repository->findOneById($id);

        if (!$job) {
            throw new NotFoundHttpException('The Job does not exist.');
        }

        $job->setIsActivated(true);

        $this->em->persist($job);
        $this->em->flush();

        $this->container->get('session')->setFlash('notice', "Your job is now online for $this->active_days days");

        $httpKernel = $this->container->get('http_kernel');
                return $httpKernel->forward('job.controller:showAction', array(
                                                'id'  => $job->getID()
                    ));

        return new RedirectResponse($this->router->generate('show',array('id'=>$job->getID(),
                                    'company' => $job->getCompanySlug(),
                                    'location' => $job->getLocationSlug(),
                                    'position' => $job->getPositionSlug())
        ));
    }

    public function extendAction($id)
    {
        $job = $this->repository->findOneById($id);

        if (!$job) {
            throw new NotFoundHttpException('The Job does not exist.');
        }

        $str = sprintf('P%sD',$this->active_days);
        $expirationDate = clone $job->getExpiresAt();
        $job->setExpiresAt($expirationDate->add(new \DateInterval($str)));

        $this->em->persist($job);
        $this->em->flush();

        return new RedirectResponse($this->router->generate('show',array('id'=>$job->getID(),
                                    'company' => $job->getCompanySlug(),
                                    'location' => $job->getLocationSlug(),
                                    'position' => $job->getPositionSlug())
        ));

    }
}
