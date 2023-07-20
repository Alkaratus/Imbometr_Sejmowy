<?php

namespace App\Entity;

use App\Repository\MemeTemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MemeTemplateRepository::class)]
class MemeTemplate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $Location = null;

    #[ORM\ManyToMany(targetEntity: Representative::class, inversedBy: 'Meme')]
    private Collection $Representative;

    #[ORM\OneToMany(mappedBy: 'Template', targetEntity: Meme::class)]
    private Collection $memes;

    public function __construct()
    {
        $this->Representative = new ArrayCollection();
        $this->memes = new ArrayCollection();
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

    public function getLocation(): ?string
    {
        return $this->Location;
    }

    public function setLocation(string $Location): static
    {
        $this->Location = $Location;

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

    /**
     * @return Collection<int, Meme>
     */
    public function getMemes(): Collection
    {
        return $this->memes;
    }

    public function addMeme(Meme $meme): static
    {
        if (!$this->memes->contains($meme)) {
            $this->memes->add($meme);
            $meme->setTemplate($this);
        }

        return $this;
    }

    public function removeMeme(Meme $meme): static
    {
        if ($this->memes->removeElement($meme)) {
            // set the owning side to null (unless already changed)
            if ($meme->getTemplate() === $this) {
                $meme->setTemplate(null);
            }
        }

        return $this;
    }
}
