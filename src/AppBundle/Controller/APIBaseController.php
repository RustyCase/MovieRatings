<?php 
// src/AppBundle/Controller/APIBaseController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

abstract class APIBaseController extends Controller {

	protected function isJsonRequest(Request $request) {
		$contentType = $request->headers->get('Content-Type');
		return 0 === strpos($contentType, 'application/json');
	}
}