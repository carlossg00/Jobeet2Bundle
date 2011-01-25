<?php

namespace Application\Jobeet2Bundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\IntegerField;
use Symfony\Component\Form\CheckboxField;
use Symfony\Component\Form\DateTimeField;
use Symfony\Component\Form\ChoiceField;

class JobForm extends Form
{

    public function configure() {

        $this->addOption('categories');
        $this->addOption('categoryTransformer');

       $this->add(new ChoiceField('category',array(
            'choices'=>$this->getOption('categories'),
            'value_transformer' => $this->getOption('categoryTransformer'),
            )));

        $this->add(new TextField('type'));
        $this->add(new TextField('company'));
        $this->add(new TextField('logo'));
        $this->add(new TextField('url'));
        $this->add(new TextField('position'));
        $this->add(new TextField('location'));
        $this->add(new TextField('description'));
        $this->add(new TextField('how_to_apply'));
        $this->add(new TextField('token'));
        $this->add(new CheckboxField('is_Public'));
        $this->add(new CheckboxField('is_activated'));
        $this->add(new TextField('email'));
        //$this->add(new DateTimeField('expires_at'));
        //$this->add(new DateTimeField('created_at'));
        //$this->add(new DateTimeField('updated_at'));
    }
}



