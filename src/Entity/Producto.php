<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductoRepository::class)
 */
class Producto
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
    private $denominacion;

    /**
     * @ORM\Column(type="float")
     */
    private $precio;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $imagenes = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDenominacion(): ?string
    {
        return $this->denominacion;
    }

    public function setDenominacion(string $denominacion): self
    {
        $this->denominacion = $denominacion;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getImagenes(): ?array
    {
        return $this->imagenes;
    }

    public function setImagenes(?array $imagenes): self
    {
        $this->imagenes = $imagenes;

        return $this;
    }

    public function __toString()
    {
        return $this->getDenominacion();
    }

}
