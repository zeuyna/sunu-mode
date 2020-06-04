<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 * itemOperation = {
 * "get" = { },
 * 
 * "put" = { 
 * "access_control"="is_granted( 'PUT' , object)"
 *    },
 * "delete" = {
 * "access_control"="is_granted('DELETE' , object)"
 *        }     
 * },
 * collectionOperations = {
 *   "get" = {},
 *   "post" = {"access_control"="is_granted('DELETE' , object)"}
 *   
 * 
 * }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role
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
}
