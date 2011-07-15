<?php
// src/Testing/MongoBundle/Form/Runner.php

namespace Application\Jobeet2Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Bridge\Doctrine\Form\DataTransformer\EntityToIdTransformer;
use Symfony\Bridge\Doctrine\Form\ChoiceList\EntityChoiceList;
use Application\Jobeet2Bundle\Form\CategoryType;
use Application\Jobeet2Bundle\Entity\Job;
use Doctrine\ORM\EntityManager;


class JobType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
       $builder->add('category','entity',array('class' => 'Application\Jobeet2Bundle\Entity\Category'));
       /*$builder->add(
            $builder->create('category','choice')
                ->appendClientTransformer(new EntityToIdTransformer(
                    new EntityChoiceList($this->em,'Application\Jobeet2Bundle\Entity\Category'))
            ));*/


        $builder->add('type','choice',array('choices' => Job::getJobTypes(),'required' => false, 'expanded' => true,));
        $builder->add('company');
        $builder->add('logo','file',array('required'=>false));
        $builder->add('url','text',array('required'=>false));
        $builder->add('position','text');
        $builder->add('location','text');
        $builder->add('description','textarea');
        $builder->add('how_to_apply','textarea',array('label' => 'How to apply?'));
        $builder->add('is_public','checkbox',array('required'=>false,'label' => 'Public?'));
        $builder->add('email','text');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Application\Jobeet2Bundle\Entity\Job',
        );
    }

    public function getName()
    {
        return 'job';
    }
}