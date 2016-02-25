<?php 
// tests/AppBundle/Services/Security/PasswordHelperTest.php

namespace Tests\AppBundle\Services\Security;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Services\Security\PasswordHelper;
use AppBundle\Entity\User;

class PasswordHelperTest extends KernelTestCase {
	
	private $container;
	
	protected function setUp() {
		$kernel = $this->createKernel();
		$kernel->boot();
		$this->container = $kernel->getContainer();
	}
	
	private function getTestSalt() {
		$salt = "vygMqxgryj7YPeCBAA9puI0Phn4X6Ri9XlMXGx9T";
		return $salt;
	}
	
	private function getTestPassword() {
		// password = user1234
		$password = "xllNopXVJ5NaZXCoK/ePsa8mVS3ueFyXT0Ym+L0NgkQ5dt7SZQbzUPzPPw2OM0mz68SEOz/L7lbEZHxFoUIzMw==";
		return $password;
	}
	
	private function getDefaultPasswordHelper() {
		$efi = $this->container->get('security.encoder_factory');
		$service = new PasswordHelper($efi);
		return $service;
	}
	
	public function testSetNewPassword() {
		$user = new User();
		$beforeSalt = "testSalt";
		$beforePassword = "testPassword";
		$user->setSalt($beforeSalt)->setPassword($beforePassword);
		
		$service = $this->getDefaultPasswordHelper();
		$service->setNewPassword($user, "user1234");
		$afterSalt = $user->getSalt();
		$afterPassword = $user->getPassword();
		
		$this->assertTrue($beforeSalt !== $afterSalt && $beforePassword !== $afterPassword);
	}
	
	public function testCheckPassword() {
		$user = new User();
		$user->setSalt($this->getTestSalt());
		$user->setPassword($this->getTestPassword());
		
		$service = $this->getDefaultPasswordHelper();
		
		$actual = $service->checkPassword($user, "user1234");
		$this->assertTrue($actual);
	}
	
	public function testResetPassword() {
		$user = new User();
		$user->setSalt($this->getTestSalt())->setPassword($this->getTestPassword());
		
		$service = $this->getDefaultPasswordHelper();
		
		$before = $user->getPassword();
		$after = $service->resetPassword($user);
		
		$this->assertNotEquals($before, $after);
		
		$sanity = $service->checkPassword($user, "user1234");
		$this->assertFalse($sanity);
	}
	
}