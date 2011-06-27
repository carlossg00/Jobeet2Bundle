<?php

namespace Application\Jobeet2Bundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class Jobeet2Controller extends Controller
{
    /**
     * @Route("/", name="_homepage")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $repository = $em->getRepository('Jobeet2Bundle:Category');
    	
    	$categories = $repository->getWithJobs();
       
        return $this->render('Jobeet2Bundle::index.html.twig',
                array('categories'=>$categories,
                	  'nJobsPage' =>$this->container->getParameter('jobeet2.max_jobs_on_homepage'),
                	));

    }    
}
