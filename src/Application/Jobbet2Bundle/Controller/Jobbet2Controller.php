<?php

namespace Application\Jobbet2Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Jobbet2Controller extends Controller
{
    public function indexAction($name)
    {
        return $this->render('Jobbet2Bundle:Jobbet2:index.twig', array('name' => $name));

    }
}
