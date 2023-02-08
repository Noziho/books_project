<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'Book')]
    private ?Borrower $borrower = null;

    #[ORM\Column]
    private ?bool $borrow_status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getBorrower(): ?Borrower
    {
        return $this->borrower;
    }

    public function setBorrower(?Borrower $borrower): self
    {
        $this->borrower = $borrower;

        return $this;
    }

    public function isBorrowStatus(): ?bool
    {
        return $this->borrow_status;
    }

    public function setBorrowStatus(bool $borrow_status): self
    {
        $this->borrow_status = $borrow_status;

        return $this;
    }
}
