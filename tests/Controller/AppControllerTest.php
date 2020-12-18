<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Request;
use App\Entity\Jobs;
use App\Form\JobsRegisterType;

class AppController extends WebTestCase
{
    // public function testSubmitValidData()
    // {
    //     $formData = [
    //         'test' => 'test',
    //         'test2' => 'test2',
    //     ];
    //     $objetJob = new Jobs();
    //     $form = $this->createForm(JobsRegisterType::class, $objetJob);
    //     $form->submit($formData);
    //     $this->assertTrue($form->isSynchronized);
    //     $view = $form->createView();
    //     $jobs = $view->job;

    //     foreach (array_keys($formData) as $key){
    //         $this->assertArrayHasKey($key, $job);
    //     }
    // }

    // public function testnewJob()
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/newJob');
    //     $this->assertEquals(302, $client->getResponse()->getStatusCode());
    // }    

    // public function testutilisateur()
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/utilisateur');
    //     $this->assertEquals(200, $client->getResponse()->getStatusCode());
    // }   

    public function testshowJob()
    {
        $client = static::createClient();
        $client->request('GET', '/showJob');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }   

    public function testshowJobCateory()
    {
        $client = static::createClient();
        $client->request('GET', '/showJobCategory');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testshowJobContrast()
    {
        $client = static::createClient();
        $client->request('GET', '/showJobContrast');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testshowJobCity()
    {
        $client = static::createClient();
        $client->request('GET', '/showJobCity');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testshowJobByTitle()
    {
        $client = static::createCLient();
        $client->request('GET', '/showJobByTitle');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testshowSpecJob()
    {
        $client = static::createClient();
        $client->request('GET', '/showSpecJob');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testdeleteJob()
    {
        $client = static::createClient();
        $client->request('GET', '/delete');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testupdateJob()
    {
        $client = static::createClient();
        $client->request('GET', '/update');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}