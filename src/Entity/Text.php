<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TextRepository")
 */
class Text
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $name;
    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $filename;
    /**
     * @ORM\Column(type="text")
     */
    private $original;

    /**
     * @ORM\Column(type="text")
     */
    private $translated;

    /**
     * @ORM\Column(type="json_array")
     */
    private $data;

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

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;
        return $this;
    }

    public function getOriginal(): ?string
    {
        return $this->original;
    }

    public function setOriginal(string $original): self
    {
        $this->original = $original;
        return $this;
    }

    public function getTranslated(): ?string
    {
        return $this->translated;
    }

    public function setTranslated(string $translated): self
    {
        $this->translated = $translated;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): self
    {
        $this->data = $data;
        return $this;
    }
}
