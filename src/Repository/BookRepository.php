<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @return Book[] Returns an array of Book objects
     */
    public function findAllBooks(): array
    {
        return $this->findAll();
    }

    /**
     * @param int $id
     * @return Book|null Returns a Book object or null if not found
     */
    public function findBookById(int $id): ?Book
    {
        return $this->find($id);
    }

    /**
     * @param string $title
     * @param string $author
     * @return Book[] Returns an array of Book objects
     */
    public function findByTitleOrAuthor(string $title, string $author): array
    {
        return $this->createQueryBuilder('b')
            ->where('b.title LIKE :title')
            ->orWhere('b.author LIKE :author')
            ->setParameter('title', '%'.$title.'%')
            ->setParameter('author', '%'.$author.'%')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $title
     * @return Book|null Returns a Book object or null if not found
     */
    public function findOneByTitle(string $title): ?Book
    {
        return $this->createQueryBuilder('b')
            ->where('b.title = :title')
            ->setParameter('title', $title)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param string $author
     * @return Book[] Returns an array of Book objects
     */
    public function findByAuthor(string $author): array
    {
        return $this->createQueryBuilder('b')
            ->where('b.author = :author')
            ->setParameter('author', $author)
            ->getQuery()
            ->getResult();
    }
}