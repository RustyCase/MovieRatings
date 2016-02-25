<?php 
// src/AppBundle/Services/MovieService.php

namespace AppBundle\Services;

use Symfony\Bridge\Doctrine\RegistryInterface;

class MovieService {
	
	private $registryInterface;
	
	public function __construct(RegistryInterface $registryInterface) {
		$this->registryInterface = $registryInterface;
	}
	
	public function getMovies() {
		
		$rep = $this->registryInterface->getRepository("AppBundle:Movie");
		// $movies = $rep->findAll();
		$movies = $rep->getMovies();
		
		return $movies;
		
	}
	
	public function getMovie($id) {
		
		$rep = $this->registryInterface->getRepository("AppBundle:Movie");
		$movie = $rep->find($id);
		
		return $movie; 
	}
	
}