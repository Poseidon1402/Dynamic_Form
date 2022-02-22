<?php

namespace App\Controller;

use App\Entity\Student;
use App\Entity\Students;
use App\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends AbstractController
{
    #[Route('/', name: 'subscribe_path', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $student = new Students;

        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($request);

        return $this->render('application/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
