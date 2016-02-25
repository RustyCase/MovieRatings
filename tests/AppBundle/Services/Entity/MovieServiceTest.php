<?php 
// tests/AppBundle/Services/MovieServiceTest.php

namespace Tests\AppBundle\Services\Entity;

use AppBundle\Services\Entity\MovieService;
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
		
		$this->assertTrue(count($movies) > 0);
	}
	
	public function testGetMovie() {
		$service = $this->getDefaultService();
		$movie = $service->getMovie(2);
		
		$expected = "Big Trouble in Little China";
		$actual = $movie->getTitle();
		$this->assertEquals($expected, $actual);
	}
	
	public function testGetMovieArray() {
		$service = $this->getDefaultService();
		$movie = $service->getMovieArray(2);
		
		$this->assertArrayHasKey('title', $movie);
		$expected = "Big Trouble in Little China";
		$actual = $movie['title'];
		$this->assertEquals($expected, $actual);
	}
	
	public function testCreateMovieFromArray() {
		$arr = array(
			'title' => 'Movie Service Test Movie',
			'description' => 'Movie Service Test Movie',
			'director' => 'Movie Service Tester',
			'release_date' => '2000-01-01 00:00:00',
		);
		$service = $this->getDefaultService();
		$movie = $service->createMovieFromArray($arr);
		$this->assertNotNull($movie);
		$this->assertTrue($movie->getId() > 0);
	}
}