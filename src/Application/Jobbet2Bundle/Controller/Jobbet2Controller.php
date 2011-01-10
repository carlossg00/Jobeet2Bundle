<?php

namespace Application\Jobbet2Bundle\Controller;

use Application\Jobbet2Bundle\Entity\Job;
use Application\Jobbet2Bundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\IntegerField;
use Symfony\Component\Form\CheckboxField;

class Jobbet2Controller extends Controller
{
    public function indexAction()
    {
        //$conn = $this->get('database_connection');
        //$jobs = $conn->fetchAll('SELECt * FROM job');

        //$job = new Job();
        //$job->setCompany("companyName");
        $em = $this->get('doctrine.orm.entity_manager');
        $query = $em->createQuery('SELECT j FROM Jobbet2Bundle:Job j');
        $jobs = $query->getResult();
        

        //$jobs = $em->find('Jobbet2Bundle:Job');
        //$em->persist($job);
        //$em->flush();
        

        return $this->render('Jobbet2Bundle:Jobbet2:index.twig',
                array('jobs'=>$jobs));

    }

    public function showAction()
    {

        $job = new Job();
        //$user->setName('dsd');

        $form = new Form('user',$job,$this->get('validator'));
        $form->add(new TextField('category'));
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
        $form->add(new TextField('expires_at'));
        /*$form->add(new TextField('Created at'));
        $form->add(new TextField('Updated at'));
         */

        // submmited data

        if ('POST' == $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->request->get('job'));

            if ($form->isValid()) {
                // save $job object and redirect
                $em = $this->get('doctrine.orm.entity_manager');
                $em->persist($job);
                $em->flush();
            }
        }



        return $this->render('Jobbet2Bundle:Jobbet2:index.twig',
                array('form'=>$form));

    }


    public function editAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $job = $em->createQuery('SELECT j FROM Jobbet2Bundle:Job WHERE id = ?', $id);
        $em->flush();

    }

    public function deleteAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $job = $em->createQuery('SELECT j FROM Jobbet2Bundle:Job WHERE id = ?', $id);
        $em->remove($job);
        $em->flush();

    }


}
