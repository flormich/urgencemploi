<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersJobsRepository")
 */
class UsersJobs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Jobs", inversedBy="usersJobs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $jobs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppUsers", inversedBy="usersJobs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJobs(): ?Jobs
    {
        return $this->jobs;
    }

    public function setJobs(?Jobs $jobs): self
    {
        $this->jobs = $jobs;
        return $this;
    }

    public function getUsers(): ?AppUsers
    {
        return $this->users;
    }

    public function setUsers(?AppUsers $users): self
    {
        $this->users = $users;
        return $this;
    }
}
