<?php

namespace Application\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HelloController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('HelloBundle:Hello:index.php', array('name' => $name));

        // render a Twig template instead
        // return $this->render('HelloBundle:Hello:index.twig', array('name' => $name));
    }
}
