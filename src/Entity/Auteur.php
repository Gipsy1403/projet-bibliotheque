<?php

namespace App\Entity;

use App\Repository\AuteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuteurRepository::class)]
class Auteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom = null;

    /**
     * @var Collection<int, Livre>
     */
    #[ORM\OneToMany(targetEntity: Livre::class, mappedBy: 'auteur')]
    private Collection $emprunt;

    public function __construct()
    {
        $this->emprunt = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
     $trimmed=trim($nom)  
	$this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
		
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
	$trimmed=trim($prenom)
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, Livre>
     */
    public function getEmprunt(): Collection
    {
        return $this->emprunt;
    }

    public function addEmprunt(Livre $emprunt): static
    {
        if (!$this->emprunt->contains($emprunt)) {
            $this->emprunt->add($emprunt);
            $emprunt->setAuteur($this);
        }

        return $this;
    }

    public function removeEmprunt(Livre $emprunt): static
    {
        if ($this->emprunt->removeElement($emprunt)) {
            // set the owning side to null (unless already changed)
            if ($emprunt->getAuteur() === $this) {
                $emprunt->setAuteur(null);
            }
        }

        return $this;
    }
}
