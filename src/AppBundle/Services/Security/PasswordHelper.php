<?php 

namespace AppBundle\Services\Security;

use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use AppBundle\Entity\User;

class PasswordHelper {
	
	private $encoderFactory;
	
	public function __construct(EncoderFactoryInterface $efi) {
		$this->encoderFactory = $efi;
	}
	
	public function setNewPassword(User $user, $password) {
		$encoder = $this->encoderFactory->getEncoder($user);
		$salt = base64_encode(random_bytes(30));
		$encoded = $encoder->encodePassword($password, $salt);
		$user->setSalt($salt);
		$user->setPassword($encoded);
	}
	
	public function checkPassword(User $user, $password) {
		$encoder = $this->encoderFactory->getEncoder($user);
		$encoded = $encoder->encodePassword($password, $user->getSalt());
		$current = $user->getPassword();
		return hash_equals($current, $encoded);
	}
	
	public function resetPassword(User $user) {
		$reset = base64_encode(random_bytes(15));
		$this->setNewPassword($user, $reset);
		return $reset;
	}
	
}