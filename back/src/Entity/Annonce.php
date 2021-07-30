<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\NumericFilter;


/**
 * @ApiResource(
 *     collectionOperations={
 *          "get",
 *          "post"={
 *              "security"="is_granted('ROLE_USER')"
 *          }
 *      },
 *      itemOperations={
 *          "get",
 *          "put"={
 *              "security"="is_granted('ROLE_ADMIN') or object.garage.professionnel == user"
 *          },
 *          "delete"={
 *              "security"="is_granted('ROLE_ADMIN') or object.garage.professionnel == user"
 *          },
 *          "patch"={
 *              "security"="is_granted('ROLE_ADMIN') or object.garage.professionnel == user"
 *          }
 *      },
 *
 *     normalizationContext={
 *          "groups"={"annonce:get"}
 *      }
 * )
 * @ApiFilter(SearchFilter::class, properties={"referenceAnnonce"="partial","title"="partial","miseEnCirculation"="partial",
 *     "modele.marque.name"="partial","modele.denomination"="partial","carburant.type"="partial","garage.name"="partial",
 *     "garage.ville"="partial"})
 *
 * @ApiFilter(RangeFilter::class, properties={"kilometers", "miseEnCirculation", "price",})
 *
 * @ApiFilter(DateFilter::class, properties={"datePublication"})
 *
 * @ApiFilter(NumericFilter::class, properties={"miseEnCirculation"})
 *
 * @ORM\Entity(repositoryClass=AnnonceRepository::class)
 */
class Annonce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"annonce:get","garage:get","image:get","modele:get"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"annonce:get"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=500)
     * @Groups({"annonce:get"})
     */
    private $descComplete;

    /**
     * @ORM\Column(type="string", length=255)
     *@Groups({"annonce:get","garage:get","image:get","modele:get"})
     */
    private $referenceAnnonce;

    /**
     * @ORM\Column(type="integer")
     *@Groups({"annonce:get"})
     */
    private $miseEnCirculation;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"annonce:get"})
     */
    private $kilometers;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     * @Groups({"annonce:get"})
     */
    private $price;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"annonce:get","garage:get","image:get","modele:get"})
     */
    private $publicationDate;

    /**
     * @ORM\ManyToOne(targetEntity=Modele::class, inversedBy="annonces")
     * @Groups({"annonce:get"})
     */
    private $modele;

    /**
     * @ORM\ManyToOne(targetEntity=Garage::class, inversedBy="annonces")
     * @Groups({"annonce:get"})
     */
    public $garage;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="annonce")
     * @Groups({"annonce:get"})
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity=Carburant::class, inversedBy="annonces")
     * @Groups({"annonce:get"})
     */
    private $carburant;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getDescComplete(): ?string
    {
        return $this->descComplete;
    }

    public function setDescComplete(string $descComplete): self
    {
        $this->descComplete = $descComplete;

        return $this;
    }

    public function getReferenceAnnonce(): ?string
    {
        return $this->referenceAnnonce;
    }

    public function setReferenceAnnonce(string $referenceAnnonce): self
    {
        $this->referenceAnnonce = $referenceAnnonce;

        return $this;
    }

    public function getMiseEnCirculation(): ?int
    {
        return $this->miseEnCirculation;
    }

    public function setMiseEnCirculation(int $miseEnCirculation): self
    {
        $this->miseEnCirculation = $miseEnCirculation;

        return $this;
    }

    public function getKilometers(): ?int
    {
        return $this->kilometers;
    }

    public function setKilometers(int $kilometers): self
    {
        $this->kilometers = $kilometers;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): self
    {
        $this->garage = $garage;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setAnnonce($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getAnnonce() === $this) {
                $image->setAnnonce(null);
            }
        }

        return $this;
    }

    public function getCarburant(): ?Carburant
    {
        return $this->carburant;
    }

    public function setCarburant(?Carburant $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }
}
