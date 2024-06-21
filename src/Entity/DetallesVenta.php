<?php

namespace App\Entity;

use App\Repository\DetallesVentaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetallesVentaRepository::class)]
class DetallesVenta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $cantidad = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $precio_unitario = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $subtotal = null;

    #[ORM\ManyToOne(inversedBy: 'detallesVentas')]
    private ?Ventas $venta_id = null;

    #[ORM\ManyToOne(inversedBy: 'detallesVentas')]
    private ?Productos $producto_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(?int $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getPrecioUnitario(): ?string
    {
        return $this->precio_unitario;
    }

    public function setPrecioUnitario(?string $precio_unitario): static
    {
        $this->precio_unitario = $precio_unitario;

        return $this;
    }

    public function getSubtotal(): ?string
    {
        return $this->subtotal;
    }

    public function setSubtotal(?string $subtotal): static
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    public function getVentaId(): ?Ventas
    {
        return $this->venta_id;
    }

    public function setVentaId(?Ventas $venta_id): static
    {
        $this->venta_id = $venta_id;

        return $this;
    }

    public function getProductoId(): ?Productos
    {
        return $this->producto_id;
    }

    public function setProductoId(?Productos $producto_id): static
    {
        $this->producto_id = $producto_id;

        return $this;
    }
}
