<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryJobRepository")
 */
class CategoryJob
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
    private $name_cat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCat(): ?string
    {
        return $this->name_cat;
    }

    public function setNameCat(string $name_cat): self
    {
        $this->name_cat = $name_cat;

        return $this;
    }
}
