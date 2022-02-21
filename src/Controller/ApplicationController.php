<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends AbstractController
{
    #[Route('/', name: 'subscribe_path', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return $this->render('application/index.html.twig', compact('form'));
    }
}
