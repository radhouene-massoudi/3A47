<?php

namespace App\Entity;

use App\Repository\GradeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GradeRepository::class)]
class Grade
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'gt', targetEntity: Student::class)]
    private Collection $st;

    public function __construct()
    {
        $this->st = new ArrayCollection();
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
     * @return Collection<int, Student>
     */
    public function getSt(): Collection
    {
        return $this->st;
    }

    public function addSt(Student $st): self
    {
        if (!$this->st->contains($st)) {
            $this->st->add($st);
            $st->setGt($this);
        }

        return $this;
    }

    public function removeSt(Student $st): self
    {
        if ($this->st->removeElement($st)) {
            // set the owning side to null (unless already changed)
            if ($st->getGt() === $this) {
                $st->setGt(null);
            }
        }

        return $this;
    }
}
