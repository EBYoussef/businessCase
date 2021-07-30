<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *
 *     collectionOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_ADMIN')"
 *          },
 *          "post"={
 *              "security"="is_granted('ROLE_USER')"
 *          }
 *      },
 *      itemOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_ADMIN') or object.annonce.garage.professionnel == user"
 *          },
 *          "put"={
 *              "security"="is_granted('ROLE_ADMIN') or object.annonce.garage.professionnel == user"
 *          },
 *          "delete"={
 *              "security"="is_granted('ROLE_ADMIN') or object.annonce.garage.professionnel == user"
 *          },
 *          "patch"={
 *              "security"="is_granted('ROLE_ADMIN') or object.annonce.garage.professionnel == user"
 *          }
 *      },
 *
 *     normalizationContext={
 *          "groups"={"image:get"}
 *      }
 * )
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"annonce:get","image:get"})
     */
    private $legende;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"annonce:get","image:get"})
     */
    private $path;

    /**
     * @ORM\ManyToOne(targetEntity=Annonce::class, inversedBy="images")
     * @Groups({"image:get"})
     */
    public $annonce;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLegende(): ?string
    {
        return $this->legende;
    }

    public function setLegende(?string $legende): self
    {
        $this->legende = $legende;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getAnnonce(): ?Annonce
    {
        return $this->annonce;
    }

    public function setAnnonce(?Annonce $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }
}
