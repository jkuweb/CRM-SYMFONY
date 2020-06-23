<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ClienteRepository::class)
 */
class Cliente
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
    private $nombre;

    /**
     * @ORM\Column(type="string", length=9)
     * @Assert\NotBlank(message="El dni es requerido")
     * @Assert\Regex(
     *     "/^[0-9]{8,8}[A-Za-z]$/s",
     *     message="DNI no válido")
     */
    private $dni;

    /**
     * @ORM\OneToOne(targetEntity=Domicilio::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $domicilio;

    /**
     * @ORM\OneToMany(targetEntity=DatoDeContacto::class, mappedBy="cliente", orphanRemoval=true, cascade={"persist"})
     */
    private $datosDeContacto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    public function __construct()
    {
        $this->datosDeContacto = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getDomicilio(): ?Domicilio
    {
        return $this->domicilio;
    }

    public function setDomicilio(Domicilio $domicilio): self
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    /**
     * @return Collection|DatoDeContacto[]
     */
    public function getDatosDeContacto(): Collection
    {
        return $this->datosDeContacto;
    }

    public function addDatosDeContacto(DatoDeContacto $datosDeContacto): self
    {
        if (!$this->datosDeContacto->contains($datosDeContacto)) {
            $this->datosDeContacto[] = $datosDeContacto;
            $datosDeContacto->setCliente($this);
        }

        return $this;
    }

    public function removeDatosDeContacto(DatoDeContacto $datosDeContacto): self
    {
        if ($this->datosDeContacto->contains($datosDeContacto)) {
            $this->datosDeContacto->removeElement($datosDeContacto);
            // set the owning side to null (unless already changed)
            if ($datosDeContacto->getCliente() === $this) {
                $datosDeContacto->setCliente(null);
            }
        }

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
}
