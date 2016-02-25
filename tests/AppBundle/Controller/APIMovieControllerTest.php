<?php
// tests/AppBundle/Controller/APIMovieControllerTest.php

namespace Tests\AppBundle\Controller;

class APIMovieControllerTest extends APIBaseControllerTest {
	
	public function testGetMovies() {
		
		$client = static::createClient();
		$crawler = $client->request("GET", "/api/movies");
		$response = $client->getResponse();
		$this->assertJsonResponse($response, 200);
		
		$data = json_decode($response->getContent(), true);
		$this->assertArrayHasKey('success', $data);
		$this->assertArrayHasKey('movies', $data);
	}
	
	public function testCreateMovies_Unauthorized() {
		$client = static::createClient(array(), array(
			// Don't send authentication information...
		));
		$crawler = $client->request(
			"POST",
			"/api/movies",
			array(),
			array(),
			array('CONTENT_TYPE' => 'application/json'),
			'{"title":"some title"}'
		);
		$response = $client->getResponse();
		$statusCode = $response->getStatusCode();
		$this->assertEquals($statusCode, 401);
	}
	
	public function testCreateMovie() {
		$client = static::createClient(array(), array(
			'PHP_AUTH_USER' => 'testadmin',
			'PHP_AUTH_PW' => 'testadmin1234',
		));
		$data = array(
			'title' => 'Unit Test Created Movie',
			'description' => 'Unit Test Created Movie',
			'director' => 'Unit Test',
			'release_date' => '2000-01-01 00:00:00',
		);
		$data = json_encode($data);	
		$crawler = $client->request(
			"POST", 
			"/api/movies", 
			array(), 
			array(), 
			array('CONTENT_TYPE' => 'application/json'),
			$data
		);
		$response = $client->getResponse();
		$expected = 201;
		$actual = $response->getStatusCode();
		$this->assertEquals($expected, $actual);
	}
	
}