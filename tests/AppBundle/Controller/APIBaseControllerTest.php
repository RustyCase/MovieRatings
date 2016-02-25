<?php 
// tests/AppBundle/Controller/APIBaseControllerTest.php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class APIBaseControllerTest extends WebTestCase {
	
	protected function assertJsonResponse($response, $statusCode) {
		$this->assertEquals(
			$statusCode, 
			$response->getStatusCode(), 
			$response->getContent()
		);
		$this->assertTrue(
			$response->headers->contains('Content-Type', 'application/json'),
			$response->headers
		);
	}
	
}