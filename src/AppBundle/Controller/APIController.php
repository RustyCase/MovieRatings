<?php 
// src/AppBundle/Controller/APIController.php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class APIController extends Controller {
	
	/**
	 * @Route("/api/movies")
	 */
	public function getMoviesAction() {
		
		$service = $this->get('movie_service');
		$movies = $service->getMovies();
		
		$json = json_encode(array (
			'success' => true,
			'movies' => $movies,
		));
		
		$response = new Response($json, 200);
		$response->headers->set('Content-Type', 'application/json');
		return $response;
	}
	
	/**
	 * @Route("/api/movies/{id}")
	 * 
	 * @param int $id
	 */
	public function getMovie($id) {
		
		$service = $this->get('movie_service');
		$movie = $service->getMovie($id);
		error_log(gettype($movie));
		
		$json = json_encode(array (
			'success' => true,
			'movie' => (array)$movie,
		));
		
		$response = new Response($json, 200);
		$response->headers->set('Content-Type', 'application/json');
		return $response;
	}
	
}