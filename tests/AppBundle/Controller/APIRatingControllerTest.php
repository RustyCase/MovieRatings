<?php 
// tests/AppBundle/Controller/APIRatingControllerTest.php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class APIRatingControllerTest extends WebTestCase {
	
	public function testRateMovie_Unauthorized() {
		
		$client = static::createClient(array(), array(
			// Don't send authentication information...
		));
		$crawler = $client->request(
			"POST",
			"/api/ratings/1",
			array(),
			array(),
			array('CONTENT_TYPE' => 'application/json'),
			'{"rating":5}'
		);
		$response = $client->getResponse();
		$statusCode = $response->getStatusCode();
		$this->assertEquals($statusCode, 401);
	}
	
	public function testRateMovie() {

		$client = static::createClient(array(), array(
			'PHP_AUTH_USER' => 'testuser',
			'PHP_AUTH_PW' => 'testuser1234'
		));
		$crawler = $client->request(
				"POST",
				"/api/ratings/1",
				array(),
				array(),
				array('CONTENT_TYPE' => 'application/json'),
				'{"rating":5}'
		);
		$response = $client->getResponse();
		$statusCode = $response->getStatusCode();
		$this->assertEquals($statusCode, 301);
	}
	
}