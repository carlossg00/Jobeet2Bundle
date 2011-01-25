<?php

namespace Application\Jobeet2Bundle\Controller;

use Application\Jobeet2Bundle\Entity\Job;
use Application\Jobeet2Bundle\Entity\User;
use Application\Jobeet2Bundle\Entity\Category;
use Application\Jobeet2Bundle\Form\JobForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\DoctrineBundle\Form\ValueTransformer\EntityToIDTransformer;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Doctrine\ORM\Events;
use Application\Jobeet2Bundle\Listener\JobEventListener;



class JobController extends Controller
{
    protected $job;

    protected function getEm()
    {
        return $this->get('doctrine.orm.entity_manager');
    }    
 

    public function indexAction()
    {

        $categories = $this->getEm()->getRepository('Jobeet2Bundle:Category')->findAllJobsByCategory();
       
        return $this->render('Jobeet2Bundle:Jobeet2:index.twig.html',
                array('categories'=>$categories));

    }

    public function showAction($id)
    {

        $em = $this->getEm();
        $this->job = $em->find("Jobeet2Bundle:Job",$id);

        if (!$this->job) {
            throw new NotFoundHttpException('The Job does not exist.');
        }
        return $this->render('Jobeet2Bundle:Jobeet2:show.twig.html',
            array('job'=>$this->job));
        
    }

    public function updateAction($id)
    {

        $em = $this->getEm();
        $this->job = $em->find("Jobeet2Bundle:Job",$id);
        
        if (!$this->job) {
            throw new NotFoundHttpException('The Job does not exist.');
        }


        // submmited data

        if ('POST' == $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->request->get('job'));

            if ($form->isValid()) {
                // save $job object and redirect
                $em->flush();
                return $this->redirect($this->generateUrl('index'));

            }
        }

        return $this->render('Jobeet2Bundle:Jobeet2:update.twig.html',
                array('form'=>$form));       

    }

  
    public function newAction()
    {

        $em = $this->getEm();

        $categories = $this->getEm()->getRepository('Jobeet2Bundle:Category')->findAllIndexedById();
        $job = new Job();

        $categoryTransformer = new EntityToIDTransformer(array(
            'em' => $em,
            'className' => 'Jobeet2Bundle:Category',
        ));

        $form = new JobForm('job', $job, $this->get('validator'),
                array('categories' => $categories,'categoryTransformer' => $categoryTransformer));


        /*retrieve parameter from container
        $active_days = $this->container->getParameter('jobeet2.active_days');
        $job->setActiveDays($active_days);*/

        
        if ('POST' == $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->request->get('job'));

            if ($form->isValid()) {
                // save $job object and redirect   
                $em->persist($job);
                $em->flush();

                return $this->redirect($this->generateUrl('index'));
            }

        }

        return $this->render('Jobeet2Bundle:Jobeet2:new.twig.html',
                array('form'=>$form));
        
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

        return $this->redirect($this->generateUrl('index'));

    }

    public function editAction($id)
    {
        $em = $this->getEm();
        $this->job = $em->find("Jobeet2Bundle:Job",$id);

         if (!$this->job) {
            throw new NotFoundHttpException('The Job does not exist.');
        }


        $categories = $this->getEm()->getRepository('Jobeet2Bundle:Category')->findAllIndexedById();

        $categoryTransformer = new EntityToIDTransformer(array(
            'em' => $this->getEm(),
            'className' => 'Jobeet2Bundle:Category',
        ));

        $form = new JobForm('job', $this->job, $this->get('validator'),
                array('categories' => $categories,'categoryTransformer' => $categoryTransformer));

        if ('POST' == $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->request->get('job'));

            if ($form->isValid()) {
                // save $job object and redirect
                $em->flush();
                return $this->redirect($this->generateUrl('index'));

            }
        }

        return $this->render('Jobeet2Bundle:Jobeet2:edit.twig.html',
                array('form'=>$form,'id'=>$id));        
    }
}
