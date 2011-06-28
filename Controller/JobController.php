<?php

namespace Application\Jobeet2Bundle\Controller;

use Application\Jobeet2Bundle\Entity\Job;
use Application\Jobeet2Bundle\Entity\User;
use Application\Jobeet2Bundle\Entity\Category;
use Application\Jobeet2Bundle\Form\JobType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



class JobController extends Controller
{
    /**
     * @Route("/", name="_job_category_list")
     */
    
    public function listAction(Category $category = null, $max = 10)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $repository = $em->getRepository('Jobeet2Bundle:Job');
    	 	
        if (null !== $category) {            
            $jobs = $repository->getActiveJobsByCategory($category, $max);
        } else {
            $jobs = $repository->findAll(true);
        }
        
        return $this->render('Jobeet2Bundle:Job:list.html.twig', array(
            'jobs'      => $jobs,
            'category'  => $category,           
        ));
        
    }
    

    /**
     * @Route("/show/{company}/{location}/{id}/{position}", name="_job_show")
     */


    public function showAction($id)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $repository = $em->getRepository('Jobeet2Bundle:Job');

        $job = $repository->findOneById($id);
        
        if (!$job) {
            throw new NotFoundHttpException('The Job does not exist.');
        }
        return $this->render('Jobeet2Bundle:Job:show.html.twig',
            array('job'=>$job,
                 'active_days' => $this->container->getParameter('jobeet2.active_days')
            ));
        
    }

    /**
     * @Route("/{token}/show", name="_job_show_tokenized")
     */

    public function showTokenizedAction($token)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $repository = $em->getRepository('Jobeet2Bundle:Job');

        $job = $repository->findOneByToken($token);

        if (!$job) {
            throw new NotFoundHttpException('The Job does not exist.');
        }
        return $this->render('Jobeet2Bundle:Job:show.html.twig',
            array('job'=>$job,
                 'active_days' => $this->container->getParameter('jobeet2.active_days')
            ));

    }


    /**
     * @Route("/{token}/delete", name="_job_delete")
     */

    public function deleteAction($token)
    {

        $em = $this->get('doctrine')->getEntityManager();
        $repository = $em->getRepository('Jobeet2Bundle:Job');

        $this->container->get('session')->setFlash('notice', 'Your changes were saved!');

        $job = $repository->findOneByToken($token);

        if (!$job) {
            throw new NotFoundHttpException('The Job does not exist.');
        }

        $em->remove($job);
        $em->flush();

        return $this->redirect($this->generateUrl('_homepage'));



    }

    /**
     * @Route("/create", name="_job_create")
     * @Route("{token}/edit", name="_job_edit")
     */


    public function editAction($token = null)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $repository = $em->getRepository('Jobeet2Bundle:Job');

        if (isset($token)) {
            $job = $repository->findOneByToken($token);

            if (!$job) {
                throw new NotFoundHttpException('The Job does not exist.');
            }

        } else {
            $job = new Job();
        }

        $form = $this->createForm(new JobType(),$job);
        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $em->persist($job);
                $em->flush();

                return $this->redirect($this->generateUrl('_job_show_tokenized'
                                ,array('token'=>$job->getToken())
                ));
            }
         }

        return $this->render('Jobeet2Bundle:Job:create.html.twig',
        		array('form' => $form->createView(),
        		));
    }

    /**
     * @Route("/{token}/publish", name="_job_publish")
     */

    public function publishAction($token)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $repository = $em->getRepository('Jobeet2Bundle:Job');

        $job = $repository->findOneByToken($token);

        if (!$job) {
            throw new NotFoundHttpException('The Job does not exist.');
        }

        $job->setIsActivated(true);

        $em->persist($job);
        $em->flush();

        $active_days = $this->container->getParameter('jobeet2.active_days');
        $this->get('session')->setFlash('notice',
                "Your job is now online for $active_days days");


        return $this->redirect($this->generateUrl('_job_show_tokenized'
                                ,array('token'=>$job->getToken())
                ));
    }

    /**
     * @Route("/{token}/extend", name="_job_extend")
     */

    public function extendAction($token)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $repository = $em->getRepository('Jobeet2Bundle:Job');

        $job = $repository->findOneById($token);

        if (!$job) {
            throw new NotFoundHttpException('The Job does not exist.');
        }

        $str = sprintf('P%sD',$this->active_days);
        $expirationDate = clone $job->getExpiresAt();
        $job->setExpiresAt($expirationDate->add(new \DateInterval($str)));

        $em->persist($job);
        $em->flush();

        return $this->redirect($this->generateUrl('_job_show_tokenized'
                                ,array('token'=>$job->getToken())
                ));

    }
}
