<?php

namespace Application\Jobeet2Bundle\Controller;

use Application\Jobeet2Bundle\Entity\Job;
use Application\Jobeet2Bundle\Entity\User;
use Application\Jobeet2Bundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\DoctrineBundle\Form\ValueTransformer\EntityToIDTransformer;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\IntegerField;
use Symfony\Component\Form\CheckboxField;
use Symfony\Component\Form\DateTimeField;
use Symfony\Component\Form\ChoiceField;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



class JobController extends Controller
{
    protected $job;

    protected function getEm()
    {
      return $this->get('doctrine.orm.entity_manager');
    }


    protected function getForm() {

        $em = $this->getEm();
        $categoryChoices = array();
        $categories = $em->getRepository('Jobeet2Bundle:Category')->findAll();
        foreach ($categories as $category) {
            $categoryChoices[$category->getId()] = $category->getName();
        }

        $categoryTransformer = new EntityToIDTransformer(array(
            'em' => $em,
            'className' => 'Jobeet2Bundle:Category',
        ));

        $form = new Form('job',$this->job,$this->get('validator'));
        $form->add(new ChoiceField('category',array(
            'choices'=>$categoryChoices,
            'value_transformer' => $categoryTransformer,
            )));
        
        $form->add(new TextField('type'));
        $form->add(new TextField('company'));
        $form->add(new TextField('logo'));
        $form->add(new TextField('url'));
        $form->add(new TextField('position'));
        $form->add(new TextField('location'));
        $form->add(new TextField('description'));
        $form->add(new TextField('how_to_apply'));
        $form->add(new TextField('token'));
        $form->add(new CheckboxField('is_Public'));
        $form->add(new CheckboxField('is_activated'));
        $form->add(new TextField('email'));
        //$form->add(new DateTimeField('expires_at'));
        //$form->add(new DateTimeField('created_at'));
        //$form->add(new DateTimeField('updated_at'));

        return $form;
    }

    protected function getActiveJobs()
    {
       $em = $this->getEm();

        $date = new \DateTime('now');
        $query = $em->createQuery('SELECT j FROM Jobeet2Bundle:Job j
            WHERE j.expires_at > ?1 ORDER BY j.expires_at DESC');

        $query->setParameter(1, $date->format('Y-m-d'));
        return $jobs = $query->getResult();
    }

    public function indexAction()
    {

        $jobs = $this->getActiveJobs();
        return $this->render('Jobeet2Bundle:Jobeet2:index.twig.html',
                array('jobs'=>$jobs));

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

        $form = $this->getForm();

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

    /**
     *
     * @TODO: override some save method to update expire_at date
     */
    public function newAction()
    {
        $em = $this->getEm();
        $this->job = new Job();

        $form = $this->getForm();

        if ('POST' == $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->request->get('job'));

            if ($form->isValid()) {
                // save $job object and redirect   
                
                $date = new \DateTime('2011-12-15');
                $str = 'P'.$this->get('jobeet2.active_days').'D';
                $this->job->setExpiresAt($date->add(new \DateInterval($str)));
                
                $em->persist($this->job);
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
        $em->remove($job);
        $em->flush();

        return $this->redirect($this->generateUrl('index'));

    }

    public function editAction($id)
    {
        $em = $this->getEm();
        $this->job = $em->find("Jobeet2Bundle:Job",$id);

        $form = $this->getForm();

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
