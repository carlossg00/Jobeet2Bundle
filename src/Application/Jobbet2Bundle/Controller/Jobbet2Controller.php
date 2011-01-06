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

        $job = new Job();
        //$user->setName('dsd');

        $form = new Form('user',$user,$this->get('validator'));
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


        return $this->render('Jobbet2Bundle:Jobbet2:index.twig',
                array('form'=>$form));

    }
}
