<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *  itemOperation = {
 * "get" = { },
 *
 * "put" = { 
 * "security"="is_granted( 'PUT' , object)"
 *    },
 * "delete" = {
 * "security"="is_granted('DELETE' , object)"
 *        }     
 * },
 * collectionOperations = {
 *   "get" = {},
 *   "post" = {"security"="is_granted('ROLE_ADMIN')"}
 *   
 * 
 * }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\SizeRepository")
 */
class Size
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
