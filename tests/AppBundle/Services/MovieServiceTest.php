<?php 
// tests/AppBundle/Services/MovieServiceTest.php

namespace Tests\AppBundle\Services;

use AppBundle\Services\MovieService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MovieServiceTest extends KernelTestCase {
	
	private $container;
	
	protected function setUp() {
		$kernel = $this->createKernel();
		$kernel->boot();
		$this->container = $kernel->getContainer();
	}
	
	private function getDefaultService() {
		$registry = $this->container->get('doctrine');
		$service = new MovieService($registry);
		return $service;
	}
	
	public function testGetMovies() {
		$service = $this->getDefaultService();
		$movies = $service->getMovies();
		
		$expected = 5;
		$actual = count($movies);
		$this->assertEquals($expected, $actual);
	}
	
	public function testGetMovie() {
		$service = $this->getDefaultService();
		$movie = $service->getMovie(2);
		
		$expected = "Big Trouble in Little China";
		$actual = $movie->getTitle();
		$this->assertEquals($expected, $actual);
	}
	
}