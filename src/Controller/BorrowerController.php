<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Borrower;
use App\Repository\ShelfRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BorrowerController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $manager;

    /**
     * @param EntityManagerInterface $entity
     */
    public function __construct (EntityManagerInterface $entity)
    {
        $this->manager = $entity;
    }

    /**
     * @return Response
     */
    #[Route('/borrower', name: 'app_borrower')]
    public function index(): Response
    {
        return $this->render('borrower/index.html.twig', [
            'controller_name' => 'BorrowerController',
        ]);
    }

    /**
     * @param string $name
     * @return Response
     */
    #[Route('/addBorrower/{name}')]
    public function addBorrower (string $name): Response
    {
        $borrower = new Borrower();
        $borrower->setName($name);

        $this->manager->persist($borrower);
        $this->manager->flush();

        return $this->render('home/index.html.twig');
    }

    /**
     * @param Borrower $borrower
     * @param Book $book
     * @return Response
     */
    #[Route('/borrow/{id}/{borrower}')]
    public function borrowBook (Book $book, Borrower $borrower, ShelfRepository $repository): Response
    {
        $book->setBorrower($borrower);
        $book->setBorrowStatus(1);

        $this->manager->flush();

        return $this->render('home/index.html.twig', [
            "shelfs" => $repository->findAll(),
        ]);

    }
}
