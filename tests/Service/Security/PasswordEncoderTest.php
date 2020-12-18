<?php

namespace App\Service\Security;

use App\Entity\AppUsers;
use App\Service\Security\PasswordEncoder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class PasswordEncoderTest extends WebTestCase
{
    // public function testencode()
    // {
    //     $user = new AppUsers();        
    //     $user->setPassword('foo');
    //     $PasswordUser = new PasswordEncoder(new UserPasswordEncoder());
    //     $password = $PasswordUser->encoder.encode($user);
    //     // $password = $user->encode($pass);
    //     // $password = $user->getPassword();
    //     $this->assertNotEquals('foo', $password);
    // }

    public function testencode()
    {
        $user = new AppUsers();
        $user->setPassword('foo');
        $passwordUser = $user->getPassword();
        $this->assertEquals('foo', $passwordUser);
    }
}