<?php

namespace App\Service\Security;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class PasswordEncoder
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function encode(UserInterface $user): UserInterface
    {
        return $user->setPassword(
            $this->encoder->encodePassword($user, $user->getPassword())
        );
    }
}