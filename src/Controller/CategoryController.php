<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Shelf;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    private EntityManagerInterface $manager;

    public function __construct (EntityManagerInterface $entity)
    {
        $this->manager = $entity;
    }
    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route('/addCategory/{name}/{id}')]
    public function addCategory (string $name, Shelf $shelf): Response
    {
        $category = new Category();
        $category
            ->setName($name)
            ->setShelf($shelf);

        $this->manager->persist($category);
        $this->manager->flush();

        return $this->render('home/index.html.twig');
    }
}
