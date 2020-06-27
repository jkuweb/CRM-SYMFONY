<?php

namespace App\Entity;

use App\Repository\ProductoPedidoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductoPedidoRepository::class)
 */
class ProductoPedido
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $cantidad;


    /**
     * @ORM\ManyToOne(targetEntity=Pedido::class, inversedBy="productoPedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pedido;

    /**
     * @ORM\Column(type="integer")
     */
    private $total;

    /**
     * @ORM\ManyToOne(targetEntity=Producto::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $producto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }


    public function getPedido(): ?Pedido
    {
        return $this->pedido;
    }

    public function setPedido(?Pedido $pedido): self
    {
        $this->pedido = $pedido;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getProducto(): ?Producto
    {
        return $this->producto;
    }

    public function setProducto(?Producto $producto): self
    {
        $this->producto = $producto;

        return $this;
    }
}
