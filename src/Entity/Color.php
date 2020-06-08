<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 * itemOperations = {
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
 * @ORM\Entity(repositoryClass="App\Repository\ColorRepository")
 */
class Color
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
    private $wording;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeHexa;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWording(): ?string
    {
        return $this->wording;
    }

    public function setWording(string $wording): self
    {
        $this->wording = $wording;

        return $this;
    }

    public function getCodeHexa(): ?string
    {
        return $this->codeHexa;
    }

    public function setCodeHexa(string $codeHexa): self
    {
        $this->codeHexa = $codeHexa;

        return $this;
    }
}
