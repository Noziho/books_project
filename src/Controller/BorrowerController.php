<?php

namespace App\Controller;

use App\Entity\Borrower;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BorrowerController extends AbstractController
{
    private EntityManagerInterface $manager;

    public function __construct (EntityManagerInterface $entity)
    {
        $this->manager = $entity;
    }
    #[Route('/borrower', name: 'app_borrower')]
    public function index(): Response
    {
        return $this->render('borrower/index.html.twig', [
            'controller_name' => 'BorrowerController',
        ]);
    }

    #[Route('/addBorrower/{name}')]
    public function addBorrower (string $name): Response
    {
        $borrower = new Borrower();
        $borrower->setName($name);

        $this->manager->persist($borrower);
        $this->manager->flush();

        return $this->render('home/index.html.twig');
    }
}
