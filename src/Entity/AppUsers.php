<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Cache\VoidCache;

/**
 *@ORM\Entity(repositoryClass="App\Repository\AppUsersRepository")
 *@UniqueEntity(fields="username", message="Cet identifiant existe déjà")
 *@UniqueEntity(fields="mail", message="Cet email existe déjà")
 *@ORM\Table(name="users",uniqueConstraints={@ORM\UniqueConstraint(name="username_id", columns={"username"})})
 */
class AppUsers implements UserInterface, \serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="username", type="string", length=190, unique=true)     
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(name="password", type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=190)
     */
    private $mail;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppRoles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UsersJobs", mappedBy="users", orphanRemoval=true)
     */
    private $usersJobs;

    public function getRoles()
    {
        return [$this->role->getValue()];
    }
    public function setRoles(array $role): void
    {
        $this->role = $role;
    }

    public function __construct()
    {
        $this->jobs = new ArrayCollection();
        $this->usersJobs = new ArrayCollection();
    }

    public function getMail()
    {
        return $this->mail;
    }
    
    public function setMail($mail)
    {
        $this->mail = $mail;
        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername(): ? string
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
        return $this;
    }

    public function getFirstname(): ? string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname(): ? string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getPassword(): ? string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }

    public function getSalt()
    {
        return null;
    }
 
    public function eraseCredentials()
    {
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** 
    * 
    *@see \Serializable::unserialize() 
    */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
             // see section on salt below
             // $this->salt
         ) = unserialize($serialized, array('allowed_classes' => false));
    }

    public function getRole(): ?AppRoles
    {
        return $this->role;
    }

    public function setRole(?AppRoles $role): self
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return Collection|UsersJobs[]
     */
    public function getUsersJobs(): Collection
    {
        return $this->usersJobs;
    }

    public function addUsersJob(UsersJobs $usersJob): self
    {
        if (!$this->usersJobs->contains($usersJob)) {
            $this->usersJobs[] = $usersJob;
            $usersJob->setUsers($this);
        }
        return $this;
    }

    public function removeUsersJob(UsersJobs $usersJob): self
    {
        if ($this->usersJobs->contains($usersJob)) {
            $this->usersJobs->removeElement($usersJob);
            // set the owning side to null (unless already changed)
            if ($usersJob->getUsers() === $this) {
                $usersJob->setUsers(null);
            }
        }
        return $this;
    }
}
