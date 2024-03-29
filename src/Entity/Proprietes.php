<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProprietesRepository")
 *
 */
class Proprietes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbre_vues;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;



    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $iIs_featured;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isvisible;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ContratTypeOptions", inversedBy="proprietes", cascade={"persist", "remove"})
     */
    private $TypeOptions;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ProprieteTypeOption", inversedBy="proprietes", cascade={"persist", "remove"})
     */
    private $ProprieteOptions;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createatAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Media", mappedBy="Propriete")
     */
    private $media;


    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Disponibilite;

    /**
     * @ORM\ManyToOne(targetEntity=Quartier::class, inversedBy="proprietes")
     * @Assert\NotBlank()
     */
    private $Quartier;

    /**
     * @ORM\OneToMany(targetEntity=Messages::class, mappedBy="proprietes")
     */
    private $messages;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $createdBy;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $updateBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $UpdateAt;

    /**
     * @ORM\OneToMany(targetEntity=ProprietesImage::class, mappedBy="Proprietes")
     */
    private $proprietesImages;

    /**
     * Proprietes constructor.
     */
    public function __construct()
    {
        $this->iIs_featured = false;
        $this->nbre_vues = 0;
        $this->isvisible = false;
        $this->Disponibilite = true;
        $this->createatAt = new DateTime();
        $this->media = new ArrayCollection();

        $this->messages = new ArrayCollection();
        $this->proprietesImages = new ArrayCollection();

        $this->Quartier = "98";
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getNbreVues(): ?int
    {
        return $this->nbre_vues;
    }

    public function setNbreVues(?int $nbre_vues): self
    {
        $this->nbre_vues = $nbre_vues;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }



    public function getIIsFeatured(): ?bool
    {
        return $this->iIs_featured;
    }

    public function setIIsFeatured(?bool $iIs_featured): self
    {
        $this->iIs_featured = $iIs_featured;

        return $this;
    }

    public function getIsvisible(): ?bool
    {
        return $this->isvisible;
    }

    public function setIsvisible(?bool $isvisible): self
    {
        $this->isvisible = $isvisible;

        return $this;
    }

    public function getTypeOptions(): ?ContratTypeOptions
    {
        return $this->TypeOptions;
    }

    public function setTypeOptions(?ContratTypeOptions $TypeOptions): self
    {
        $this->TypeOptions = $TypeOptions;

        return $this;
    }

    public function getProprieteOptions(): ?ProprieteTypeOption
    {
        return $this->ProprieteOptions;
    }

    public function setProprieteOptions(?ProprieteTypeOption $ProprieteOptions): self
    {
        $this->ProprieteOptions = $ProprieteOptions;

        return $this;
    }

    public function getCreateatAt(): ?DateTimeInterface
    {
        return $this->createatAt;
    }

    public function setCreateatAt(DateTimeInterface $createatAt): self
    {
        $this->createatAt = $createatAt;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): self
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media[] = $medium;
            $medium->setPropriete($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->contains($medium)) {
            $this->media->removeElement($medium);
            // set the owning side to null (unless already changed)
            if ($medium->getPropriete() === $this) {
                $medium->setPropriete(null);
            }
        }

        return $this;
    }



    public function getDisponibilite(): ?bool
    {
        return $this->Disponibilite;
    }

    public function setDisponibilite(?bool $Disponibilite): self
    {
        $this->Disponibilite = $Disponibilite;

        return $this;
    }

    public function getQuartier(): ?Quartier
    {
        return $this->Quartier;
    }

    public function setQuartier(?Quartier $Quartier): self
    {
        $this->Quartier = $Quartier;

        return $this;
    }

    /**
     * @return Collection|Messages[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Messages $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setProprietes($this);
        }

        return $this;
    }

    public function removeMessage(Messages $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getProprietes() === $this) {
                $message->setProprietes(null);
            }
        }

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?UserInterface $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getupdateBy(): ?User
    {
        return $this->updateBy;
    }

    public function setupdateBy(?UserInterface $updateBy): self
    {
        $this->updateBy = $updateBy;

        return $this;
    }

    public function getUpdateAt(): ?DateTimeInterface
    {
        return $this->UpdateAt;
    }

    public function setUpdateAt(?DateTimeInterface $UpdateAt): self
    {
        $this->UpdateAt = $UpdateAt;

        return $this;
    }

    /**
     * @return Collection|ProprietesImage[]
     */
    public function getProprietesImages(): Collection
    {
        return $this->proprietesImages;
    }

    public function addProprietesImage(ProprietesImage $proprietesImage): self
    {
        if (!$this->proprietesImages->contains($proprietesImage)) {
            $this->proprietesImages[] = $proprietesImage;
            $proprietesImage->setProprietes($this);
        }

        return $this;
    }

    public function removeProprietesImage(ProprietesImage $proprietesImage): self
    {
        if ($this->proprietesImages->removeElement($proprietesImage)) {
            // set the owning side to null (unless already changed)
            if ($proprietesImage->getProprietes() === $this) {
                $proprietesImage->setProprietes(null);
            }
        }

        return $this;
    }


}
