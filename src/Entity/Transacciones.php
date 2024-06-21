<?php

namespace App\Entity;

use App\Repository\TransaccionesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransaccionesRepository::class)]
class Transacciones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64, nullable: true)]
    private ?string $tipo = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(nullable: true)]
    private ?int $cantidad = null;

    #[ORM\ManyToOne(inversedBy: 'transacciones')]
    private ?Productos $producto_id = null;

    #[ORM\ManyToOne(inversedBy: 'transacciones')]
    private ?Proveedores $proveedor_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(?string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
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

    public function getProductoId(): ?Productos
    {
        return $this->producto_id;
    }

    public function setProductoId(?Productos $producto_id): static
    {
        $this->producto_id = $producto_id;

        return $this;
    }

    public function getProveedorId(): ?Proveedores
    {
        return $this->proveedor_id;
    }

    public function setProveedorId(?Proveedores $proveedor_id): static
    {
        $this->proveedor_id = $proveedor_id;

        return $this;
    }
}
