<?php 
// tests/AppBundle/Services/Entity/RatingServiceTest.php

namespace Tests\AppBundle\Services\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Services\Entity\RatingService;

class RatingServiceTest extends KernelTestCase {
	
	private $container;
	
	protected function setUp() {
		$kernel = $this->createKernel();
		$kernel->boot();
		$this->container = $kernel->getContainer();
	}
	
	private function getDefaultService() {
		$registry = $this->container->get('doctrine');
		$service = new RatingService($registry);
		return $service;
	}
	
	public function testRateMovie() {
		
		$userId = 1;
		$movieId = 2;
		$rating = 5;
		
		$service = $this->getDefaultService();
		$rating = $service->rateMovie($userId, $movieId, $rating);
		
		$this->assertEquals($userId, $rating->getUserId()->getId());
		$this->assertEquals($movieId, $rating->getMovieId()->getId());
		$this->assertEquals(5, $rating->getRating());
	}
	
}