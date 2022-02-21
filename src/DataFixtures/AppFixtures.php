<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\Sector;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sector1 = new Sector;
        $sector1->setName('Informatic');
        $manager->persist($sector1);

        $sector2 = new Sector;
        $sector2->setName('Sciences');
        $manager->persist($sector2);

        $sector3 = new Sector;
        $sector3->setName('Letters and Humans sciences');
        $manager->persist($sector3);

        $course1 = new Course;
        $course1->setName('Software Engineer and Database Administrator');
        $course1->setSector($sector1);
        $manager->persist($course1);

        $course2 = new Course;
        $course2->setName('Systems and Network Administration');
        $course2->setSector($sector1);
        $manager->persist($course2);

        $course3 = new Course;
        $course3->setName('Big Data');
        $course3->setSector($sector1);
        $manager->persist($course3);

        $course4 = new Course;
        $course4->setName('Natural Sciences');
        $course4->setSector($sector2);
        $manager->persist($course4);

        $course5 = new Course;
        $course5->setName('Mathematics');
        $course5->setSector($sector2);
        $manager->persist($course5);

        $course6 = new Course;
        $course6->setName('Physics');
        $course6->setSector($sector2);
        $manager->persist($course6);

        $course7 = new Course;
        $course7->setName('Malagasy Language');
        $course7->setSector($sector3);
        $manager->persist($course7);

        $course8 = new Course;
        $course8->setName('English Language');
        $course8->setSector($sector3);
        $manager->persist($course8);

        $course9 = new Course;
        $course9->setName('Philosophy');
        $course9->setSector($sector3);
        $manager->persist($course9);

        $manager->flush();
    }
}
