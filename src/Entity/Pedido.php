<?php

namespace App\Entity;

use App\Repository\PedidoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PedidoRepository::class)
 */
class Pedido
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity=Cliente::class, inversedBy="pedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cliente;

    /**
     * @ORM\OneToMany(targetEntity=ProductoPedido::class, mappedBy="pedido", orphanRemoval=true, cascade={"persist"})
     */
    private $productoPedidos;

    public function __construct()
    {
        $this->productoPedidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * @return Collection|ProductoPedido[]
     */
    public function getProductoPedidos(): Collection
    {
        return $this->productoPedidos;
    }

    public function addProductoPedido(ProductoPedido $productoPedido): self
    {
        if (!$this->productoPedidos->contains($productoPedido)) {
            $this->productoPedidos[] = $productoPedido;
            $productoPedido->setPedido($this);
        }

        return $this;
    }

    public function removeProductoPedido(ProductoPedido $productoPedido): self
    {
        if ($this->productoPedidos->contains($productoPedido)) {
            $this->productoPedidos->removeElement($productoPedido);
            // set the owning side to null (unless already changed)
            if ($productoPedido->getPedido() === $this) {
                $productoPedido->setPedido(null);
            }
        }

        return $this;
    }

}
