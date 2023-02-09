<?php

namespace App\Controller;


use App\Entity\Category;
use App\Entity\Shelf;
use App\Repository\ShelfRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShelfController extends AbstractController
{

    private EntityManagerInterface $manager;

    public function __construct (EntityManagerInterface $entity)
    {
        $this->manager = $entity;
    }
    #[Route('/shelf', name: 'app_shelf')]
    public function index(): Response
    {
        return $this->render('shelf/index.html.twig', [
            'controller_name' => 'ShelfController',
        ]);
    }

    #[Route('/addShelf/{nameShelf}/{name}')]
    public function addShelf (string $nameShelf, Category $category): Response
    {
        $shelf = new Shelf();
        $shelf
            ->setName($nameShelf)
            ->addCategory($category);

        $this->manager->persist($shelf);
        $this->manager->flush();

        return $this->render('home/index.html.twig');
    }


    #[Route('/getAll')]
    public function getAllBook (ShelfRepository $repository)
    {
        $shelfs = $repository->findAll();

        foreach ($shelfs as $shelf)
        {
            dump($shelf->getCategory()->getValues());
        }
        die();
    }
}
