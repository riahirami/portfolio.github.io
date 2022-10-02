<?php

namespace App\Entity;

use Symfony\Component\Form\AbstractType;

use App\Repository\ProjetRepository;
use Doctrine\ORM\Mapping as ORM;
use Model\RebelShip;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity(repositoryClass=ProjetRepository::class)
 */
class Projet extends AbstractType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_creation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $technologies;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lien_github;

    public function __construct()
    {
        $this->date_creation = new \DateTime;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }



    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getTechnologies(): ?string
    {
        return $this->technologies;
    }

    public function setTechnologies(?string $technologies): self
    {
        $this->technologies = $technologies;

        return $this;
    }

    public function getLienGithub(): ?string
    {
        return $this->lien_github;
    }

    public function setLienGithub(?string $lien_github): self
    {
        $this->lien_github = $lien_github;

        return $this;
    }
}
