<?php

namespace App\Entity;

use App\Repository\BorrowerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BorrowerRepository::class)]
class Borrower
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'borrower', targetEntity: Book::class)]
    private Collection $Book;

    public function __construct()
    {
        $this->Book = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Book>
     */
    public function getBook(): Collection
    {
        return $this->Book;
    }

    public function addBook(Book $book): self
    {
        if (!$this->Book->contains($book)) {
            $this->Book->add($book);
            $book->setBorrower($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->Book->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getBorrower() === $this) {
                $book->setBorrower(null);
            }
        }

        return $this;
    }
}
