<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Sector;
use App\Entity\Student;
use App\Repository\SectorRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('sector', EntityType::class, [
                'class' => Sector::class,
                'choice_label' => 'name', 
                'placeholder' => 'Choose one sector',
                'query_builder' => fn(ServiceEntityRepository $service) => 
                $service->createQueryBuilder('c')->orderBy('c.name', 'ASC') 
            ])
            ->add('course', EntityType::class, [
                'class' => Course::class,
                'choice_label' => 'name',
                'query_builder' => fn(ServiceEntityRepository $service) =>
                $service->createQueryBuilder('c')->orderBy('c.name', 'ASC')
            ])
            ->add('birthDate', DateType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
