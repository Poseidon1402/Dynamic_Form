<?php

namespace App\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends AbstractController
{
    #[Route('/', name: 'subscribe_path', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        $form = $this->createFormBuilder()
            ->add('name', TextType::class)
            ->add('sector', EntityType::class)
            ->add('course', EntityType::class)
        ;
        return $this->render('application/index.html.twig', compact('form'));
    }
}
