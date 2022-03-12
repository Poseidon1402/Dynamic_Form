<?php

namespace App\Controller;

use App\Entity\Sector;
use App\Entity\Student;
use App\Entity\Students;
use App\Form\StudentType;
use App\Repository\SectorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends AbstractController
{
    #[Route('/', name: 'subscribe_path', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $em, SectorRepository $rep): Response
    {
        $student = new Students;
        $sector = $rep->findByName('informatic')[0];

        $student->setSector($sector);
        
        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($student);
            $em->flush();
        }

        return $this->render('application/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
