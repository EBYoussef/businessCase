<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ModeleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;


/**
 * @ApiResource(
 *
 *     collectionOperations={
 *          "get",
 *          "post"={
 *              "security"="is_granted('ROLE_ADMIN')"
 *          }
 *      },
 *      itemOperations={
 *          "get",
 *          "put"={
 *              "security"="is_granted('ROLE_ADMIN')"
 *          },
 *          "delete"={
 *              "security"="is_granted('ROLE_ADMIN')"
 *          },
 *          "patch"={
 *              "security"="is_granted('ROLE_ADMIN')"
 *          }
 *      },
 *
 *     normalizationContext={
 *          "groups"={"modele:get"}
 *      }
 * )
 *
 * @ApiFilter(SearchFilter::class, properties={"denomination"="partial","marque.name"="partial","annonces.title"="partial",
 *     "annonces.referenceAnnonce"="partial"})
 *
 * @ApiFilter(DateFilter::class, properties={"annonces.publicationDate"})
 *
 * @ORM\Entity(repositoryClass=ModeleRepository::class)
 */
class Modele
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"annonce:get","marque:get","modele:get"})
     */
    private $denomination;

    /**
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="modeles")
     * @Groups({"annonce:get","modele:get"})
     */
    private $marque;

    /**
     * @ORM\OneToMany(targetEntity=Annonce::class, mappedBy="modele")
     * @Groups({"modele:get"})
     */
    private $annonces;

    public function __construct()
    {
        $this->annonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDenomination(): ?string
    {
        return $this->denomination;
    }

    public function setDenomination(string $denomination): self
    {
        $this->denomination = $denomination;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * @return Collection|Annonce[]
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces[] = $annonce;
            $annonce->setModele($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getModele() === $this) {
                $annonce->setModele(null);
            }
        }

        return $this;
    }
}
