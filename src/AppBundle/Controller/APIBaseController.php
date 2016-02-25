<?php 
// src/AppBundle/Controller/APIBaseController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

abstract class APIBaseController extends Controller {

	/**
	 * Helper method to determine if the request is
	 * a json request.
	 * 
	 * @param Request $request The request.
	 * @return boolean True if the request is a json request.
	 */
	protected function isJsonRequest(Request $request) {
		$contentType = $request->headers->get('Content-Type');
		return 0 === strpos($contentType, 'application/json');
	}
}