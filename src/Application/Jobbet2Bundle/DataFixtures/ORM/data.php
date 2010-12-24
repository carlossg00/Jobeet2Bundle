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
        $job1->setCategory($cat1);
        $job1->setType("full-time");
        $job1->setCompany("Sensio Labs");
        $job1->setLogo("sensio-labs.gif");
        $job1->setUrl("http://www.sensiolabs.com");
        $job1->setPosition("Web Developer");
        $job1->setLocation("Paris, France");
        $job1->setDescription("Description");
        $job1->setHowToApply("Send your resume to fabien.pontecier [at] sensio.com");
        $job1->setIsActivated(true);
        $job1->setIsPublic(true);
        $job1->setToken("job_sensio_labs");
        $job1->setEmail("job@example.com");
        $job1->setExpiresAt(new \DateTime('now'));
        
        $manager->persist($job1);
        
        $manager->flush();


    }
}


$loader = new Loader();
$loader->addFixture(new LoadJobbetData);