<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Vich\UploaderBundle\Metadata\Driver\AnnotationDriver;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $book = new Book();
            $book->setTitle($faker->sentence)
                ->setAuthor($faker->name)
                ->setDescription($faker->paragraph)
                ->setPublicationYear($faker->year)
                ->setIsbn($faker->isbn13);
            
            $manager->persist($book);
        }

        $manager->flush();
    }
}