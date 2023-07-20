<?php

namespace App\Entity;

use App\Repository\RepresentativeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RepresentativeRepository::class)]
class Representative
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'representatives')]
    private ?Party $party = null;

    #[ORM\ManyToMany(targetEntity: Nick::class, mappedBy: 'Representative')]
    private Collection $nicks;

    #[ORM\ManyToMany(targetEntity: MemeTemplate::class, mappedBy: 'Representative')]
    private Collection $Meme;

    #[ORM\OneToMany(mappedBy: 'Representative', targetEntity: Quote::class)]
    private Collection $quotes;

    #[ORM\OneToMany(mappedBy: 'Representative', targetEntity: Event::class)]
    private Collection $events;

    public function __construct()
    {
        $this->nicks = new ArrayCollection();
        $this->Meme = new ArrayCollection();
        $this->quotes = new ArrayCollection();
        $this->events = new ArrayCollection();
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPartyId(): ?Party
    {
        return $this->party;
    }

    public function setPartyId(?Party $party): static
    {
        $this->party = $party;

        return $this;
    }

    /**
     * @return Collection<int, Nick>
     */
    public function getNicks(): Collection
    {
        return $this->nicks;
    }

    public function addNick(Nick $nick): static
    {
        if (!$this->nicks->contains($nick)) {
            $this->nicks->add($nick);
            $nick->addRepresentative($this);
        }

        return $this;
    }

    public function removeNick(Nick $nick): static
    {
        if ($this->nicks->removeElement($nick)) {
            $nick->removeRepresentative($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, MemeTemplate>
     */
    public function getMeme(): Collection
    {
        return $this->Meme;
    }

    public function addMeme(MemeTemplate $meme): static
    {
        if (!$this->Meme->contains($meme)) {
            $this->Meme->add($meme);
            $meme->addRepresentative($this);
        }

        return $this;
    }

    public function removeMeme(MemeTemplate $meme): static
    {
        if ($this->Meme->removeElement($meme)) {
            $meme->removeRepresentative($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Quote>
     */
    public function getQuotes(): Collection
    {
        return $this->quotes;
    }

    public function addQuote(Quote $quote): static
    {
        if (!$this->quotes->contains($quote)) {
            $this->quotes->add($quote);
            $quote->setRepresentative($this);
        }

        return $this;
    }

    public function removeQuote(Quote $quote): static
    {
        if ($this->quotes->removeElement($quote)) {
            // set the owning side to null (unless already changed)
            if ($quote->getRepresentative() === $this) {
                $quote->setRepresentative(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setRepresentative($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getRepresentative() === $this) {
                $event->setRepresentative(null);
            }
        }

        return $this;
    }
}
