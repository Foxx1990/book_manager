<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    private $bookRepository;
    private $entityManager;

    public function __construct(BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {
        $this->bookRepository = $bookRepository;
        $this->entityManager = $entityManager;
    }
    #[Route('/books', name: 'book_list')]
    public function list(EntityManagerInterface $em): Response
    {
        $books = $em->getRepository(Book::class)->findAll();
        return $this->render('book/index.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/books/show/{id}', name: 'book_show')]
    public function show(int $id, EntityManagerInterface $em): Response
    {
        $book = $em->getRepository(Book::class)->find($id);
        if (!$book) {
            throw $this->createNotFoundException('No book found for id '.$id);
        }

        return $this->render('book/show.html.twig', [
            'book' => $book,
        ]);
    }

    #[Route('/books/new', name: 'book_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($book);
            $em->flush();

            $this->addFlash('success', 'Book created successfully!');
            return $this->redirectToRoute('book_list');
        }

        return $this->render('book/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/books/{id}/edit', name: 'book_edit')]
    public function edit(Request $request, int $id): Response
    {
        $book = $this->bookRepository->find($id);

        if (!$book) {
            throw $this->createNotFoundException('No book found for id ' . $id);
        }

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('book_list');
        }

        return $this->render('book/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    
    }
    #[Route('/books/{id}/delete', name: 'book_delete', methods: ['POST'])]
    public function delete(Book $book, int $id, ManagerRegistry $doctrine): Response
    {
        $book = $this->bookRepository->find($id);
        $entityManager = $doctrine->getManager();
        $entityManager->remove($book);
        $entityManager->flush();

        $this->addFlash('success', 'Book deleted successfully!');
        

        return $this->redirectToRoute('book_list');
    
    }
}