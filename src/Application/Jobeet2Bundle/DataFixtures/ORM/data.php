<?php

namespace Application\Jobbet2Bundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Loader;
use Doctrine\ORM\EntityManager,
    Doctrine\Common\DataFixtures\FixtureInterface;
use Application\Jobbet2bundle\Entity;


class LoadJobbetData implements FixtureInterface
{
    public function load($manager)
    {

        $cat1 = new Entity\Category();
        $cat1->setName("Design");

        $cat2 = new Entity\Category();
        $cat2->setName("Programming");

        $cat3 = new Entity\Category();
        $cat3->setName("Manager");

        $cat4 = new Entity\Category();
        $cat4->setName("Adminstrator");
        
        $manager->persist($cat1);
        $manager->persist($cat2);
        $manager->persist($cat3);
        $manager->persist($cat4);
        
        $job1 = new Entity\Job();
        $job1->setCategory($cat2);
        $job1->setType("full-time");
        $job1->setCompany("Sensio Labs");
        $job1->setLogo("sensio-labs.gif");
        $job1->setUrl("http://www.sensiolabs.com");
        $job1->setPosition("Web Developer");
        $job1->setLocation("Paris, France");
        $job1->setDescription("You've already developed websites with symfony and you want
                to work with Open-Source technologies. You have a minimum of 3 years experience
                in web development with PHP or Java and you wish to participate to development
                of Web 2.0 sites using the best frameworks available.");
        $job1->setHowToApply("Send your resume to fabien.pontecier [at] sensio.com");
        $job1->setIsActivated(true);
        $job1->setIsPublic(true);
        $job1->setToken("job_sensio_labs");
        $job1->setEmail("job@example.com");
        $date = new \DateTime('2010-12-15');
        $job1->setExpiresAt($date->add(new \DateInterval('P30D')));
        $job1->setCreatedAt($date);
        $job1->setUpdatedAt($date);

        $job2 = new Entity\Job();
        $job2->setCategory($cat1);
        $job2->setType("part-time");
        $job2->setCompany("Extreme Sensio");
        $job2->setLogo("extreme-sensio.gif");
        $job2->setUrl("http://www.extreme-sensio.com");
        $job2->setPosition("Web Designer");
        $job2->setLocation("Paris, France");
        $job2->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing 
                elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Utenim ad minim veniam, quis nostrud exercitation ullamco laborisnisi
                ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                in. Voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                Excepteur sint occaecat cupidatat non proident, sunt in culpa
                qui officia deserunt mollit anim id est laborum.
                ");
        $job2->setHowToApply("Send your resume to fabien.pontecier [at] sensio.com");
        $job2->setIsActivated(true);
        $job2->setIsPublic(true);
        $job2->setToken("job_extreme_sensi");
        $job2->setEmail("job@example.com");
        
        $date = new \DateTime('now');
        $job2->setExpiresAt($date->add(new \DateInterval('P30D')));
        $job2->setCreatedAt($date);
        $job2->setUpdatedAt($date);

        
        $manager->persist($job1);
        $manager->persist($job2);
        
        $manager->flush();


    }
}


$loader = new Loader();
$loader->addFixture(new LoadJobbetData);