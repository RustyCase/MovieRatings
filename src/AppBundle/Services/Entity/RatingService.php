<?php 
// src/AppBundle/Services/Entity/RatingService.php

namespace AppBundle\Services\Entity;

use Symfony\Bridge\Doctrine\RegistryInterface;
use AppBundle\Entity\Rating;
use AppBundle\Entity\User;
use AppBundle\Entity\Movie;

class RatingService {

	private $registryInterface;
	
	public function __construct(RegistryInterface $registryInterface) {
		$this->registryInterface = $registryInterface;
	}
	
	public function rateMovie($userId, $movieId, $score) {
		
		$user = $this->getUser($userId);
		$movie = $this->getMovie($movieId);
		if (!$user || !$movie) {
			return false;
		}
		
		$rep = $this->registryInterface->getRepository("AppBundle:Rating");
		$rating = $rep->find(array(
			'userId' => $user->getId(), 
			'movieId' => $movie->getId(),
		));
		if (!$rating) {
			$rating = new Rating();
			$rating->setMovieId($movie);
			$rating->setUserId($user);
		}
		$rating->setRating($score);
		$rating = $this->save($rating);
		return $rating;
	}
	
	private function getUser($userId) {
		$rep = $this->registryInterface->getRepository("AppBundle:User");
		$user = $rep->find($userId);
		return $user;
	}
	
	private function getMovie($movieId) {
		$rep = $this->registryInterface->getRepository("AppBundle:Movie");
		$movie = $rep->find($movieId);
		return $movie;
	}
	
	private function save(Rating $rating) {
		$em = $this->registryInterface->getManager();
		$em->persist($rating);
		$em->flush();
		return $rating;
	}
	
}