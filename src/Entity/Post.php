<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=1500)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=1500, nullable=true)
     */
    private $desc_arabic;

    /**
     * @ORM\Column(type="string", length=1500, nullable=true)
     */
    private $desc_french;

    /**
     * @ORM\Column(type="string", length=1500, nullable=true)
     */
    private $desc_spanish;

     

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDescArabic(): ?string
    {
        return $this->desc_arabic;
    }

    public function setDescArabic(?string $desc_arabic): self
    {
        $this->desc_arabic = $desc_arabic;

        return $this;
    }

    public function getDescFrench(): ?string
    {
        return $this->desc_french;
    }

    public function setDescFrench(?string $desc_french): self
    {
        $this->desc_french = $desc_french;

        return $this;
    }

    public function getDescSpanish(): ?string
    {
        return $this->desc_spanish;
    }

    public function setDescSpanish(?string $desc_spanish): self
    {
        $this->desc_spanish = $desc_spanish;

        return $this;
    }
 
}
