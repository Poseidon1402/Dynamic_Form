<?php

namespace App\Entity;

use App\Repository\SectorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SectorRepository::class)]
#[ORM\Table(name: 'Sectors')]
class Sector
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'sector', targetEntity: Course::class, orphanRemoval: true)]
    private $course;

    #[ORM\OneToMany(mappedBy: 'sector', targetEntity: Students::class, orphanRemoval: true)]
    private $students;

    public function __construct()
    {
        $this->course = new ArrayCollection();
        $this->students = new ArrayCollection();
    }

    public function getId(): ?int
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

    /**
     * @return Collection<int, Course>
     */
    public function getCourse(): Collection
    {
        return $this->course;
    }

    public function addCourse(Course $course): self
    {
        if (!$this->course->contains($course)) {
            $this->course[] = $course;
            $course->setSector($this);
        }

        return $this;
    }

    public function removeCourse(Course $course): self
    {
        if ($this->course->removeElement($course)) {
            // set the owning side to null (unless already changed)
            if ($course->getSector() === $this) {
                $course->setSector(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Students>
     */
    public function getMention(): Collection
    {
        return $this->students;
    }

    public function addMention(Students $students): self
    {
        if (!$this->students->contains($students)) {
            $this->students[] = $students;
            $students->setSector($this);
        }

        return $this;
    }

    public function removeMention(Students $students): self
    {
        if ($this->students->removeElement($students)) {
            // set the owning side to null (unless already changed)
            if ($students->getSector() === $this) {
                $students->setSector(null);
            }
        }

        return $this;
    }
}
