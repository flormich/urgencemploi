<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobsRepository")
 */
class Jobs
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
    private $title_job;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $places_job;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $postal_code_job;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameComp_job;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $salaryRange_job;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description_job;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $phone_job;

    /**
     * @ORM\Column(type="string", length=190)
     */
    private $mail_job;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contrast")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contrast;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategoryJob")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UsersJobs", mappedBy="jobs", orphanRemoval=true)
     */
    private $usersJobs;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->usersJobs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleJob(): ?string
    {
        return $this->title_job;
    }

    public function setTitleJob(string $title_job): self
    {
        $this->title_job = $title_job;
        return $this;
    }

    public function getPlacesJob(): ?string
    {
        return $this->places_job;
    }

    public function setPlacesJob(?string $places_job): self
    {
        $this->places_job = $places_job;
        return $this;
    }

    public function getNameCompJob(): ?string
    {
        return $this->nameComp_job;
    }

    public function setNameCompJob(string $nameComp_job): self
    {
        $this->nameComp_job = $nameComp_job;
        return $this;
    }

    public function getSalaryRangeJob(): ?int
    {
        return $this->salaryRange_job;
    }

    public function setSalaryRangeJob(?int $salaryRange_job): self
    {
        $this->salaryRange_job = $salaryRange_job;
        return $this;
    }

    public function getPostalCodeJob()
    {
        return $this->postal_code_job;
    }

    public function setPostalCodeJob($postal_code_job)
    {
        $this->postal_code_job = $postal_code_job;
        return $this;
    }

    public function getDescriptionJob(): ?string
    {
        return $this->description_job;
    }

    public function setDescriptionJob(?string $description_job): self
    {
        $this->description_job = $description_job;
        return $this;
    }

    public function getPhoneJob(): ?string
    {
        return $this->phone_job;
    }

    public function setPhoneJob(string $phone_job): self
    {
        $this->phone_job = $phone_job;

        return $this;
    }

    public function getMailJob(): ?string
    {
        return $this->mail_job;
    }

    public function setMailJob(string $mail_job): self
    {
        $this->mail_job = $mail_job;

        return $this;
    }

    public function getContrast(): ?Contrast
    {
        return $this->contrast;
    }

    public function setContrast(?Contrast $contrast): self
    {
        $this->contrast = $contrast;

        return $this;
    }

    public function getCategory(): ?CategoryJob
    {
        return $this->category;
    }

    public function setCategory(?CategoryJob $category): self
    {
        $this->category = $category;

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
            $usersJob->setJobs($this);
        }

        return $this;
    }

    public function removeUsersJob(UsersJobs $usersJob): self
    {
        if ($this->usersJobs->contains($usersJob)) {
            $this->usersJobs->removeElement($usersJob);
            // set the owning side to null (unless already changed)
            if ($usersJob->getJobs() === $this) {
                $usersJob->setJobs(null);
            }
        }

        return $this;
    }

    // public function __toString()
    // {
        
    // }

    // public function getAuthor(): ?AppUsers
    // {
    //     return $this->author;
    // }

    // public function setAuthor(?AppUsers $author): self
    // {
    //     $this->author = $author;

    //     return $this;
    // }
}
