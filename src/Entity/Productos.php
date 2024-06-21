<?php

namespace App\Entity;

use App\Repository\ProductosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductosRepository::class)]
class Productos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64, nullable: true)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $precio = null;

    #[ORM\Column(nullable: true)]
    private ?int $stock = null;

    #[ORM\ManyToOne(inversedBy: 'productos')]
    private ?Categorias $categoria_id = null;

    /**
     * @var Collection<int, Transacciones>
     */
    #[ORM\OneToMany(targetEntity: Transacciones::class, mappedBy: 'producto_id')]
    private Collection $transacciones;

    /**
     * @var Collection<int, ProductoProveedores>
     */
    #[ORM\OneToMany(targetEntity: ProductoProveedores::class, mappedBy: 'producto_id')]
    private Collection $productoProveedores;

    /**
     * @var Collection<int, DetallesVenta>
     */
    #[ORM\OneToMany(targetEntity: DetallesVenta::class, mappedBy: 'producto_id')]
    private Collection $detallesVentas;

    public function __construct()
    {
        $this->transacciones = new ArrayCollection();
        $this->productoProveedores = new ArrayCollection();
        $this->detallesVentas = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->nombre;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->precio;
    }

    public function setPrecio(?string $precio): static
    {
        $this->precio = $precio;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getCategoriaId(): ?Categorias
    {
        return $this->categoria_id;
    }

    public function setCategoriaId(?Categorias $categoria_id): static
    {
        $this->categoria_id = $categoria_id;

        return $this;
    }

    /**
     * @return Collection<int, Transacciones>
     */
    public function getTransacciones(): Collection
    {
        return $this->transacciones;
    }

    public function addTransaccione(Transacciones $transaccione): static
    {
        if (!$this->transacciones->contains($transaccione)) {
            $this->transacciones->add($transaccione);
            $transaccione->setProductoId($this);
        }

        return $this;
    }

    public function removeTransaccione(Transacciones $transaccione): static
    {
        if ($this->transacciones->removeElement($transaccione)) {
            // set the owning side to null (unless already changed)
            if ($transaccione->getProductoId() === $this) {
                $transaccione->setProductoId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductoProveedores>
     */
    public function getProductoProveedores(): Collection
    {
        return $this->productoProveedores;
    }

    public function addProductoProveedore(ProductoProveedores $productoProveedore): static
    {
        if (!$this->productoProveedores->contains($productoProveedore)) {
            $this->productoProveedores->add($productoProveedore);
            $productoProveedore->setProductoId($this);
        }

        return $this;
    }

    public function removeProductoProveedore(ProductoProveedores $productoProveedore): static
    {
        if ($this->productoProveedores->removeElement($productoProveedore)) {
            // set the owning side to null (unless already changed)
            if ($productoProveedore->getProductoId() === $this) {
                $productoProveedore->setProductoId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DetallesVenta>
     */
    public function getDetallesVentas(): Collection
    {
        return $this->detallesVentas;
    }

    public function addDetallesVenta(DetallesVenta $detallesVenta): static
    {
        if (!$this->detallesVentas->contains($detallesVenta)) {
            $this->detallesVentas->add($detallesVenta);
            $detallesVenta->setProductoId($this);
        }

        return $this;
    }

    public function removeDetallesVenta(DetallesVenta $detallesVenta): static
    {
        if ($this->detallesVentas->removeElement($detallesVenta)) {
            // set the owning side to null (unless already changed)
            if ($detallesVenta->getProductoId() === $this) {
                $detallesVenta->setProductoId(null);
            }
        }

        return $this;
    }
}
