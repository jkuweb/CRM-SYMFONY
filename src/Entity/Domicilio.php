<?php

namespace App\Entity;

use App\Repository\DomicilioRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DomicilioRepository::class)
 */
class Domicilio
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
    private $calle;

    /**
     * @ORM\Column(type="integer")
     */
    private $portal;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $escalera;

    /**
     * @ORM\Column(type="integer", length=2)
     */
    private $piso;

    /**
     * @ORM\Column(type="integer")
     */
    private $zip;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ciudad;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $provincia;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCalle(): ?string
    {
        return $this->calle;
    }

    public function setCalle(string $calle): self
    {
        $this->calle = $calle;

        return $this;
    }

    public function getPortal(): ?int
    {
        return $this->portal;
    }

    public function setPortal(int $portal): self
    {
        $this->portal = $portal;

        return $this;
    }

    public function getEscalera(): ?string
    {
        return $this->escalera;
    }

    public function setEscalera(?string $escalera): self
    {
        $this->escalera = $escalera;

        return $this;
    }

    public function getPiso(): ?string
    {
        return $this->piso;
    }

    public function setPiso(string $piso): self
    {
        $this->piso = $piso;

        return $this;
    }

    public function getZip(): ?int
    {
        return $this->zip;
    }

    public function setZip(int $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function getCiudad(): ?string
    {
        return $this->ciudad;
    }

    public function setCiudad(string $ciudad): self
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    public function getProvincia(): ?string
    {
        return $this->provincia;
    }

    public function setProvincia(string $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

}
