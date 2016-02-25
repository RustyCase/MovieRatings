<?php 
// src/AppBundle/Controller/APIMovieController.php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class APIMovieController extends APIBaseController {
	
	/**
	 * @Route("/api/movies", name="movies_list")
	 * @Method("GET")
	 */
	public function getMoviesAction() {
		
		$service = $this->get('movie_service');
		$movies = $service->getMoviesArray();
		
		$json = json_encode(array (
			'success' => true,
			'movies' => $movies,
		));
		
		$response = new Response($json, 200);
		$response->headers->set('Content-Type', 'application/json');
		return $response;
	}
	
	/**
	 * @Route("/api/movies", name="movies_create")
	 * @Method("POST")
	 * @Security("has_role('ROLE_ADMIN')")
	 */
	public function createMovieAction(Request $request) {
		if (!$this->isJsonRequest($request)) {
			throw new HttpException(400);
		}
		
		$data = json_decode($request->getContent(), true);
		$service = $this->get('movie_service');
		$movie = $service->createMovieFromArray($data);
		$response = new Response();
		$response->setStatusCode(201);
		$response->headers->set('Location',
			$this->generateUrl('movies_get', array('id' => $movie->getId()), true)
		);
		return $response;
	}
	
	/**
	 * @Route("/api/movies/{id}", name="movies_get")
	 * @Method("GET")
	 * 
	 * @param int $id
	 */
	public function getMovie($id) {
		
		$service = $this->get('movie_service');
		$movie = $service->getMovieArray($id);
		
		$json = json_encode(array (
			'success' => true,
			'movie' => $movie,
		));
		
		$response = new Response($json, 200);
		$response->headers->set('Content-Type', 'application/json');
		return $response;
	}
	
}