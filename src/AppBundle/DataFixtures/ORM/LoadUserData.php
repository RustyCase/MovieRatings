<?php 
// src/AppBundle/DataFixtures/ORM/LoadUserData.php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements ContainerAwareInterface {
	
	private $container;
	
	public function setContainer(ContainerInterface $container=null) {
		$this->container = $container;
	}
	
	public function load(ObjectManager $om) {
		
		$helper = $this->container->get('password_helper');
		
		$admin = new User();
		$admin->setUsername("testadmin")
			->setAdmin(true);
		$helper->setNewPassword($admin, "testadmin1234");
		
		$user = new User();
		$user->setUsername("testuser")
			->setAdmin(false);
		$helper->setNewPassword($user, "testuser1234");
		
		$om->persist($admin);
		$om->persist($user);
		$om->flush();
		
	}
	
}