<?php

namespace App\Entity;

use App\Repository\ProductoProveedoresRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductoProveedoresRepository::class)]
class ProductoProveedores
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $precio_proveedor = null;

    #[ORM\ManyToOne(inversedBy: 'productoProveedores')]
    private ?Productos $producto_id = null;

    #[ORM\ManyToOne(inversedBy: 'productoProveedores')]
    private ?Proveedores $proveedor_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrecioProveedor(): ?string
    {
        return $this->precio_proveedor;
    }

    public function setPrecioProveedor(?string $precio_proveedor): static
    {
        $this->precio_proveedor = $precio_proveedor;

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
