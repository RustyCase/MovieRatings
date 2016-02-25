<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(columns={"username"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\UserRepository")
 */
class User implements AdvancedUserInterface {

	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="username", type="string", length=255)
	 */
	private $username;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="password", type="string", length=100)
	 */
	private $password;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="salt", type="string", length=100)
	 */
	private $salt;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="admin", type="boolean")
	 */
	private $admin;
	
	/**
	 * @var boolean
	 * 
	 * @ORM\Column(name="enabled", type="boolean")
	 */
	private $enabled;

	/**
	 * @var array AppBundle\Entity\Rating
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rating", mappedBy="userId")
	 */
	private $ratings;


	public function __construct() {
		$this->enabled = true;
		$this->ratings = new ArrayCollection();
	}
	
	/**
	 * Get id
	 * 
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Set username
	 * 
	 * @param string $username
	 * 
	 * @return User
	 */
	public function setUsername($username) {
		$this->username = $username;
		
		return $this;
	}
	
	/**
	 * Get username
	 * 
	 * @return string
	 * 
	 * {@inheritDoc}
	 * @see \Symfony\Component\Security\Core\User\UserInterface::getUsername()
	 */
	public function getUsername() {
		return $this->username;
	}
	
	/**
	 * Set password
	 * 
	 * @param string $password
	 * 
	 * @return User
	 */
	public function setPassword($password) {
		$this->password = $password;
		
		return $this;
	}
	
	/**
	 * Get password
	 * 
	 * @return string
	 * 
	 * {@inheritDoc}
	 * @see \Symfony\Component\Security\Core\User\UserInterface::getPassword()
	 */
	public function getPassword() {
		return $this->password;
	}
	
	/**
	 * Set salt
	 * 
	 * @param string $salt
	 * 
	 * @return User
	 */
	public function setSalt($salt) {
		$this->salt = $salt;
		
		return $this;
	}
	
	/**
	 * Get salt
	 * 
	 * @return string
	 * 
	 * {@inheritDoc}
	 * @see \Symfony\Component\Security\Core\User\UserInterface::getSalt()
	 */
	public function getSalt() {
		return $this->salt;
	}
	
	/**
	 * Set admin
	 * 
	 * @param boolean $admin
	 * 
	 * @return User
	 */
	public function setAdmin($admin) {
		$this->admin = $admin;
		
		return $this;
	}
	
	/**
	 * Get admin
	 * 
	 * @return boolean
	 */
	public function isAdmin() {
		return $this->admin;
	}
	
	/**
	 * Set enabled
	 * 
	 * @param boolean $enabled;
	 * 
	 * @return User
	 */
	public function setEnabled($enabled) {
		$this->enabled = $enabled;
		
		return $this;
	}
	
	/**
	 * Get enabled
	 * 
	 * @return boolean
	 */
	public function isEnabled() {
		return $this->enabled;
	}
	
	// AdvancedUserInterface methods...
	public function getRoles() {
		if ($this->admin) {
			return array('ROLE_ADMIN');
		}
		return array('ROLE_USER');
	}
	
	public function isAccountNonExpired() {
		return true;
	}
	
	public function isAccountNonLocked() {
		return true;
	}
	
	public function isCredentialsNonExpired() {
		return true;
	}
	
	public function eraseCredentials() {
		
	}

    /**
     * Get admin
     *
     * @return boolean
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Add rating
     *
     * @param \AppBundle\Entity\Rating $rating
     *
     * @return User
     */
    public function addRating(\AppBundle\Entity\Rating $rating)
    {
        $this->ratings[] = $rating;

        return $this;
    }

    /**
     * Remove rating
     *
     * @param \AppBundle\Entity\Rating $rating
     */
    public function removeRating(\AppBundle\Entity\Rating $rating)
    {
        $this->ratings->removeElement($rating);
    }

    /**
     * Get ratings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRatings()
    {
        return $this->ratings;
    }
}
