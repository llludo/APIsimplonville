<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
#[ApiResource]
class Category
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
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=Reportcitoyen::class, mappedBy="service")
     */
    private $reportcitoyens;

    public function __construct()
    {
        $this->reportcitoyens = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|Reportcitoyen[]
     */
    public function getReportcitoyens(): Collection
    {
        return $this->reportcitoyens;
    }

    public function addReportcitoyen(Reportcitoyen $reportcitoyen): self
    {
        if (!$this->reportcitoyens->contains($reportcitoyen)) {
            $this->reportcitoyens[] = $reportcitoyen;
            $reportcitoyen->setService($this);
        }

        return $this;
    }

    public function removeReportcitoyen(Reportcitoyen $reportcitoyen): self
    {
        if ($this->reportcitoyens->removeElement($reportcitoyen)) {
            // set the owning side to null (unless already changed)
            if ($reportcitoyen->getService() === $this) {
                $reportcitoyen->setService(null);
            }
        }

        return $this;
    }
}
