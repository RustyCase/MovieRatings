<?php 
// src/AppBundle/Entity/Rating.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="rating")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\RatingRepository")
 */
class Rating {
	
	/**
	 * @var int
	 * 
	 * @ORM\Id
	 * @ORM\JoinColumn(name="user_id")
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="ratings")
	 */
	private $userId;
	
	/**
	 * @var int
	 * 
	 * @ORM\Id
	 * @ORM\JoinColumn(name="movie_id")
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Movie", inversedBy="ratings")
	 */
	private $movieId;
	
	/**
	 * @var int
	 * @ORM\Column(name="rating", type="integer")
	 */
	private $rating;
	

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Rating
     */
    public function setRating($rating) {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating() {
        return $this->rating;
    }

    /**
     * Set userId
     *
     * @param \AppBundle\Entity\User $userId
     *
     * @return Rating
     */
    public function setUserId(\AppBundle\Entity\User $userId) {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \AppBundle\Entity\User
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * Set movieId
     *
     * @param \AppBundle\Entity\Movie $movieId
     *
     * @return Rating
     */
    public function setMovieId(\AppBundle\Entity\Movie $movieId) {
        $this->movieId = $movieId;

        return $this;
    }

    /**
     * Get movieId
     *
     * @return \AppBundle\Entity\Movie
     */
    public function getMovieId() {
        return $this->movieId;
    }
}
