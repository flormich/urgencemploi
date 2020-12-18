<?php

namespace App\Controller\security;

use App\Repository\AppUsersRepository;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();
        $client->request('GET', '/login');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    
    public function testAddition()
    {
        $calculator = new SecurityController();
        $result = $calculator->multi(10, 10);

        $this->assertEquals(100, $result);
    }    

    // public function testNewUser()
    // {
    //     $user = new AppUsers();
    //     $user->setName(null);
    //     $this->assertFalse($user->validate(['username']));
    // }

    public function testnew()
    {
        $client = static::createClient();
        $client->request('GET', '/new');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }    

    // public function newUser()
    // {
    //     $client = static::createClient();
    //     $crawler = $client->request('GET', '/new');
    //     $form = $crawler->selectButton('Ajouter')->form();
    //     $form['user[username]'] = 'Titi';
    //     $form['user[firstname]'] = 'TitiFirstname';
    //     $form['user[lastname]'] = 'TitiLastname';
    //     $form['user[password]'] = '123456';
    //     $form['user[phone]'] = '0202020202';
    //     $form['user[mail]'] = 'Titi@yahoo.fr';
    //     $form['user[role]'] = '1';
    //     $form['user[usersJobs'] = '2';
    //     $client->submit($form);

    //     // $crawler = $client->followRedirect();

    //     // $this->assertSame(1, $crawler_>filter('div.alert.alert-succes')->count());
    // }
}