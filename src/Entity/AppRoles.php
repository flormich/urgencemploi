<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
//  * @ORM\Entity(repositoryClass="App\Repository\AppUsersRepository")
 * @ORM\Entity(repositoryClass="App\Repository\AppRolesRepository")
 * @ORM\Table(name="roles", uniqueConstraints={@ORM\UniqueConstraint(name="name_id", columns={"name_roles"}),@ORM\UniqueConstraint(name="value_id", columns={"value_roles"})})
 */

    class AppRoles
    {
        /**
        * @ORM\Id()
        * @ORM\GeneratedValue()
        * @ORM\Column(type="integer")
        */
        private $id;

        /**
        * @ORM\Column(type="string", length=16, name="name_roles")
        */
        private $name;

        /**
         * @ORM\Column(type="string", length=16, name="value_roles")
         */
        private $value;

        public function getId()
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

        public function getValue(): ?string
        {
            return $this->value;
        }

        public function setValue(string $value): self
        {
            $this->value = $value;
            return $this;
        }
    }
