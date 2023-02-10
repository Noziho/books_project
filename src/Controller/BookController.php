<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Category;
use App\Repository\ShelfRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    private EntityManagerInterface $manager;

    public function __construct (EntityManagerInterface $entity)
    {
        $this->manager = $entity;
    }
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/addBook/{name}/{id}', name: "add_book")]
    public function addBook(string $name, Category $category, ShelfRepository $repository): Response
    {
        $book = new Book();
        $book
            ->setName($name)
            ->setCategory($category);

        $this->manager->persist($book);
        $this->manager->flush();

        return $this->render('home/index.html.twig', [
            "shelfs" => $repository->findAll(),
        ]);
    }
}
