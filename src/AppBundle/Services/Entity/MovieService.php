<?php 
// src/AppBundle/Services/MovieService.php

namespace AppBundle\Services\Entity;

use Symfony\Bridge\Doctrine\RegistryInterface;
use AppBundle\Entity\Movie;

class MovieService {
	
	private $registryInterface;
	
	public function __construct(RegistryInterface $registryInterface) {
		$this->registryInterface = $registryInterface;
	}
	
	public function getMovies() {
		
		$rep = $this->registryInterface->getRepository("AppBundle:Movie");
		$results = $rep->findAll();
		return $results;
	}
	
	public function getMoviesArray() {
		
		$results = $this->getMovies();
		$movies = array();
		foreach ($results as $movie) {
			$movies[] = $this->toArray($movie);
		}
		
		return $movies;
	}
	
	public function getMovie($id) {
		
		$rep = $this->registryInterface->getRepository("AppBundle:Movie");
		$movie = $rep->find($id);
		
		return $movie; 
	}
	
	public function getMovieArray($id) {
		$movie = $this->getMovie($id);
		return $this->toArray($movie);
	}
	
	public function createMovieFromArray(array $movieData) {
		$movie = $this->fromArray($movieData);
		$movie = $this->save($movie);
		return $movie;
	}
	
	private function save(Movie $movie) {
		$em = $this->registryInterface->getManager();
		$em->persist($movie);
		$em->flush();
		return $movie;
	}
	
	private function toArray(Movie $movie) {
		$arr = array(
			'id' => $movie->getId(),
			'title' => $movie->getTitle(),
			'description' => $movie->getDescription(),
			'director' => $movie->getDirector(),
			'release_date' => $movie->getReleaseDate()->format("Y-m-d H:i:s"),
		);
		$arr['avg_rating'] = $this->getAverageRating($movie);
		return $arr;
	}
	
	private function fromArray(array $data) {
		if (!array_key_exists('title', $data) ||
			!array_key_exists('description', $data) ||
			!array_key_exists('director', $data) || 
			!array_key_exists('release_date', $data)) {
				return null;
		}
		
		$releaseDate = \DateTime::createFromFormat('Y-m-d H:i:s', $data['release_date']);
		$movie = new Movie();
		$movie->setTitle($data['title'])
			->setDescription($data['description'])
			->setDirector($data['director'])
			->setReleaseDate($releaseDate);
		return $movie;
	}
	
	private function getAverageRating(Movie $movie) {
		$ratings = $movie->getRatings();
		$count = count($ratings);
		
		if ($count === 0) {
			return null;
		}
		
		$sum = 0;
		foreach ($ratings as $rating) {
			$sum += $rating->getRating();
		}
		$avg = round($sum / $count, 1);
		return $avg;
	}
	
}