<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
#[ApiResource(operations: [
    new Get(),
//    new Put(),
//    new Patch(),
//    new Delete(),
    new GetCollection(),
//    new Post()
])]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\OneToMany(targetEntity: Disc::class, mappedBy: 'artist')]
    private Collection $discs;

    public function __construct()
    {
        $this->discs = new ArrayCollection();
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection<int, Disc>
     */
    public function getDiscs(): Collection
    {
        return $this->discs;
    }

    public function addDisc(Disc $disc): static
    {
        if (!$this->discs->contains($disc)) {
            $this->discs->add($disc);
            $disc->setArtist($this);
        }

        return $this;
    }

    public function removeDisc(Disc $disc): static
    {
        if ($this->discs->removeElement($disc)) {
            // set the owning side to null (unless already changed)
            if ($disc->getArtist() === $this) {
                $disc->setArtist(null);
            }
        }

        return $this;
    }
}
