<?php

namespace App\Entity;

use App\Repository\PartyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartyRepository::class)]
class Party
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $Name = null;

    #[ORM\Column(length: 5)]
    private ?string $short_name = null;

    #[ORM\OneToMany(mappedBy: 'party_id', targetEntity: Representative::class)]
    private Collection $representatives;

    public function __construct()
    {
        $this->representatives = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->short_name;
    }

    public function setShortName(string $short_name): static
    {
        $this->short_name = $short_name;

        return $this;
    }

    /**
     * @return Collection<int, Representative>
     */
    public function getRepresentatives(): Collection
    {
        return $this->representatives;
    }

    public function addRepresentative(Representative $representative): static
    {
        if (!$this->representatives->contains($representative)) {
            $this->representatives->add($representative);
            $representative->setPartyId($this);
        }

        return $this;
    }

    public function removeRepresentative(Representative $representative): static
    {
        if ($this->representatives->removeElement($representative)) {
            // set the owning side to null (unless already changed)
            if ($representative->getPartyId() === $this) {
                $representative->setPartyId(null);
            }
        }

        return $this;
    }
}
