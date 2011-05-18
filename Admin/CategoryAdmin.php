<?php

//src/Application/Jobeet2Bundle/Admin/CategoryAdmin.php

namespace Application\Jobeet2Bundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class CategoryAdmin extends Admin
{
	 protected $list = array(
        'id' => array('identifier' => true),
        'name',
    );
    
    protected $form = array(
        'name',
    );
    
    protected $filter = array(
        'name',
    );
}