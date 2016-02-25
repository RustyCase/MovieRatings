<?php 
// src/AppBundle/Controller/APIRatingController.php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class APIRatingController extends APIBaseController {
	
	/**
	 * @Route("/api/ratings/{id}", name="ratings_rate")
	 * @Method("POST")
	 * @Security("has_role('ROLE_USER')")
	 * 
	 * @param int $id The movie id.
	 * @param Request $request The request.
	 */
	public function rateMovieAction($id, Request $request) {
		if (!$this->isJsonRequest($request)) {
			throw new HttpException(400);
		}
		
		// Get the current user...
		$userId = $this->getUser()->getId();
		$score = json_decode($request->getContent(), true);
		$service = $this->get('rating_service');
		$rating = $service->rateMovie($userId, $id, $score['rating']);
		
		// Upon successfully rating a movie, respond by redirecting
		// through the "movies_get" route.
		return $this->redirectToRoute('movies_get', array('id' => $id), 301);
	}
	
}