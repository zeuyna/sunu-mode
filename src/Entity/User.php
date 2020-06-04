<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ApiResource(
 *      itemOperations = {
 *          "get" = {
 *              "security"="is_granted('ROLE_ADMIN')"
 *          },
 *          "put" = {
 *              "access_control"="is_granted('PUT' , object)"
 *          },
 *          "delete" = {
 *              "access_control"="is_granted('DELETE' , object)"
 *          }
 *      },
 *      collectionOperations = {
 *          "get" = {
 *              "security"="is_granted('ROLE_ADMIN')"
 *          },
 *          "post" = {
 *              "security"="is_granted('ROLE_SUPER_ADMIN')"
 *          },
 *          "put" = {
 *              "access_control"="is_granted('PUT' , object)"
 *          },
 *          "delete" = {
 *              "access_control"="is_granted('DELETE' , object)"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
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
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity=Role::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $role;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="datetime")
     */
    private $signAt;

    public function __construct()
    {
        $this->isActive = true;
        $this->signAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->telephone;
    }

    public function getRoles()
    {
        return $this->roles = array('ROLE_'.strtoupper($this->getRole()->getWording()));
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getSignAt(): ?\DateTimeInterface
    {
        return $this->signAt;
    }

    public function setSignAt(\DateTimeInterface $signAt): self
    {
        $this->signAt = $signAt;

        return $this;
    }
}