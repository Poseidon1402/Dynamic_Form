<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Sector;
use App\Entity\Students;
use App\Repository\CourseRepository;
use App\Repository\SectorRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class StudentType extends AbstractType
{
    public function  __construct(private CourseRepository $courseRepository){}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'You must fill this field'
                    ])
                ]
            ])
            ->add('sector', EntityType::class, [
                'class' => Sector::class,
                'choice_label' => 'name', 
                'placeholder' => 'Choose one sector',
                'query_builder' => fn(ServiceEntityRepository $service) => 
                $service->createQueryBuilder('c')->orderBy('c.name', 'ASC'),
                'constraints' => [
                    new NotBlank([
                        'message' => 'This field cannot be blank'
                    ])
                ]
            ])
            /*
            ->add('course', EntityType::class, [
                'class' => Course::class,
                'choice_label' => 'name',
                'query_builder' => fn(ServiceEntityRepository $service) =>
                $service->createQueryBuilder('c')->orderBy('c.name', 'ASC'),
                'constraints' => [
                    new NotBlank([
                        'message' => 'This field cannot be blank'
                    ])
                ]
            ])
            */
            ->add('birthDate', DateType::class, [
                'widget' => 'single_text'
            ])
        ;
        
        //listen to the event PRE_SET_DATA
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event){
            $sector = $event->getData()->getSector() ?? null;
            
            //retrieve all course which is wrapped with a sector
            $course = $this->courseRepository->createQueryBuilder('c')
                ->andWhere('c.sector = :val')
                ->setParameter('val', $sector)
                ->orderBy('c.name', 'ASC')
                ->getQuery()
                ->getResult()
            ;
            
            $event->getForm()->add('course', EntityType::class, [
                'class' => Course::class,
                'choice_label' => 'name',
                'choices' => $course
            ]);
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Students::class,
            'required' => false
        ]);
    }
}
