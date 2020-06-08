<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ApiResource(
 *      itemOperations = {
 *          "get" ,
 *          "put" = {
 *              "security"="is_granted('ROLE_ADMIN')"
 *          },
 *          "delete" = {
 *              "security"="is_granted('ROLE_ADMIN')"
 *          }
 *      },
 *      collectionOperations = {
 *          "get" ,
 *          "post" = {
 *              "security"="is_granted('ROLE_ADMIN')"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $qtInStock;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Color")
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity=Cart::class, inversedBy="article")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->color = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getQtInStock(): ?int
    {
        return $this->qtInStock;
    }

    public function setQtInStock(int $qtInStock): self
    {
        $this->qtInStock = $qtInStock;

        return $this;
    }

    /**
     * @return Collection|Color[]
     */
    public function getColor(): Collection
    {
        return $this->color;
    }

    public function addColor(Color $color): self
    {
        if (!$this->color->contains($color)) {
            $this->color[] = $color;
        }

        return $this;
    }

    public function removeColor(Color $color): self
    {
        if ($this->color->contains($color)) {
            $this->color->removeElement($color);
        }

        return $this;
    }

    public function getUser(): ?Cart
    {
        return $this->user;
    }

    public function setUser(?Cart $user): self
    {
        $this->user = $user;

        return $this;
    }
}
