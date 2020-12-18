<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContrastRepository")
 */
class Contrast
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
    private $type_contrast;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeContrast(): ?string
    {
        return $this->type_contrast;
    }

    public function setTypeContrast(string $type_contrast): self
    {
        $this->type_contrast = $type_contrast;

        return $this;
    }
}
