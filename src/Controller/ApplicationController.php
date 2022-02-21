<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends AbstractController
{
    #[Route('/', name: 'subscribe_path', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        $student = new Student;

        $form = $this->createForm(StudentType::class, $student);

        return $this->render('application/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
