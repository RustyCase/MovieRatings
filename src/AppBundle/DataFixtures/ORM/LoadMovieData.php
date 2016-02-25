<?php 
// src/AppBundle/DataFixtures/ORM/LoadMovieData.php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Movie;

class LoadMovieData implements FixtureInterface {
	
	public function load(ObjectManager $om) {
		
		$movie1 = new Movie();
		$movie1->setTitle("The Thing");
		$description = "The ultimate in alien terror.";
		$movie1->setDescription($description);
		$releaseDate = \DateTime::createFromFormat("m-d-Y", "06-25-1982");
		$movie1->setReleaseDate($releaseDate);
		$movie1->setDirector("John Carpenter");
		
		$movie2 = new Movie();
		$movie2->setTitle("Big Trouble in Little China");
		$description = "Jack Burton's in for some serious trouble and you're in for some serious fun.";
		$movie2->setDescription($description);
		$releaseDate = \DateTime::createFromFormat("m-d-Y", "07-01-1986");
		$movie2->setReleaseDate($releaseDate);
		$movie2->setDirector("John Carpenter");
		
		$movie3 = new Movie();
		$movie3->setTitle("They Live");
		$description = "" .
				"You see them on the street. You watch them on TV. " .
				"You might even vote for one this fall. " .
				"You think they're people just like you. " .
				"You're wrong. Dead wrong.";
		$movie3->setDescription($description);
		$releaseDate = \DateTime::createFromFormat("m-d-Y", "11-04-1988");
		$movie3->setReleaseDate($releaseDate);
		$movie3->setDirector("John Carpenter");
		
		$movie4 = new Movie();
		$movie4->setTitle("Memoirs of an Invisible Man");
		$description = "" .
				"Women want him for his wite. The C.I.A. wants him for his body. " .
				"All Nick wants is his molecules back.";
		$movie4->setDescription($description);
		$releaseDate = \DateTime::createFromFormat("m-d-Y", "02-28-1992");
		$movie4->setReleaseDate($releaseDate);
		$movie4->setDirector("John Carpenter");
		
		$movie5 = new Movie();
		$movie5->setTitle("Ghosts of Mars");
		$description = "Terror is the same on any planet.";
		$movie5->setDescription($description);
		$releaseDate = \DateTime::createFromFormat("m-d-Y", "08-24-2001");
		$movie5->setReleaseDate($releaseDate);
		$movie5->setDirector("John Carpenter");
		
		$om->persist($movie1);
		$om->persist($movie2);
		$om->persist($movie3);
		$om->persist($movie4);
		$om->persist($movie5);
		$om->flush();
	}
	
}