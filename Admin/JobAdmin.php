<?php

//src/Application/Jobeet2Bundle/Admin/JobAdmin.php

namespace Application\Jobeet2Bundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class JobAdmin extends Admin
{
	protected $list = array(
        'company' => array('identifier' => true),
        'position',
        'location',        
        'is_activated',
        'email',
        'category',
        'expires_at',
		'_action' => array(
            'actions' => array(
                'delete' => array(),
                'edit' => array(),
            )
        ),
    );   
     

    protected $maxPerPage = 5;

    protected $form = array(
        'category',
        'type',
        'company',
        'logo',
        'url',
        'position',
        'location',
        'description',
        'how_to_apply',
        'is_public',
        'email',
        'is_activated',
    );

    protected $filter = array(
           'category',
           'company',
           'position',
           'description',
           'is_activated',
           'is_public',
           'email',
//           'expiresAt',   #Bundle still without date filters
    );
}