<?php

namespace App\Entity;

use App\Repository\NickRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NickRepository::class)]
class Nick
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Representative::class, inversedBy: 'nicks')]
    private Collection $Representative;

    public function __construct()
    {
        $this->Representative = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Representative>
     */
    public function getRepresentative(): Collection
    {
        return $this->Representative;
    }

    public function addRepresentative(Representative $representative): static
    {
        if (!$this->Representative->contains($representative)) {
            $this->Representative->add($representative);
        }

        return $this;
    }

    public function removeRepresentative(Representative $representative): static
    {
        $this->Representative->removeElement($representative);

        return $this;
    }
}
