<?php

namespace App\DataFixtures;

set_time_limit(6000); 
ini_set("memory_limit", -1);

use App\Entity\Book;
use Vich\UploaderBundle\Metadata\Driver\AnnotationDriver;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $batchSize = 2000;
        $faker = Factory::create();
        for ($i = 0; $i < 1000000; $i++) {
            $book = new Book();
            $book->setTitle($faker->sentence)
                ->setAuthor($faker->name)
                ->setDescription($faker->paragraph)
                ->setPublicationYear($faker->year)
                ->setIsbn($faker->isbn13);
            
            $manager->persist($book);
            if (($i % $batchSize) == 0) {
                $manager->flush();
                $manager->clear();
           }
        }

        $manager->flush();
        $manager->clear();
    }
}