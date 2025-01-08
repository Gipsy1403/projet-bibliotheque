<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_publication = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\ManyToOne(inversedBy: 'emprunt')]
    #[ORM\JoinColumn(nullable: false)]
    private ?auteur $auteur = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?FicheEmprunt $emprunt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = {{$titre|upper}};

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->date_publication;
    }

    public function setDatePublication(\DateTimeInterface $date_publication): static
    {
        $this->date_publication = $date_publication;
		if ($date_publication=="null"){
			return $date_publication|DateTime()
		}
        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getAuteur(): ?auteur
    {
        return $this->auteur;
    }

    public function setAuteur(?auteur $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getEmprunt(): ?FicheEmprunt
    {
        return $this->emprunt;
    }

    public function setEmprunt(FicheEmprunt $emprunt): static
    {
        $this->emprunt = $emprunt;

        return $this;
    }
}

