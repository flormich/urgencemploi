<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MediaManagementController extends AbstractController
{
    /**
     * @Route("/media/management", name="media_management")
     */
    public function index()
    {
        return $this->render('media_management/index.html.twig', [
            'controller_name' => 'MediaManagementController',
        ]);
    }
}
