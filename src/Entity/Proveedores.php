<?php

namespace App\Entity;

use App\Repository\ProveedoresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProveedoresRepository::class)]
class Proveedores
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64, nullable: true)]
    private ?string $nombre = null;

    #[ORM\Column(length: 64, nullable: true)]
    private ?string $contacto = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $direccion = null;

    /**
     * @var Collection<int, Transacciones>
     */
    #[ORM\OneToMany(targetEntity: Transacciones::class, mappedBy: 'proveedor_id')]
    private Collection $transacciones;

    /**
     * @var Collection<int, ProductoProveedores>
     */
    #[ORM\OneToMany(targetEntity: ProductoProveedores::class, mappedBy: 'proveedor_id')]
    private Collection $productoProveedores;

    public function __construct()
    {
        $this->transacciones = new ArrayCollection();
        $this->productoProveedores = new ArrayCollection();
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

    public function getContacto(): ?string
    {
        return $this->contacto;
    }

    public function setContacto(?string $contacto): static
    {
        $this->contacto = $contacto;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): static
    {
        $this->direccion = $direccion;

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
            $transaccione->setProveedorId($this);
        }

        return $this;
    }

    public function removeTransaccione(Transacciones $transaccione): static
    {
        if ($this->transacciones->removeElement($transaccione)) {
            // set the owning side to null (unless already changed)
            if ($transaccione->getProveedorId() === $this) {
                $transaccione->setProveedorId(null);
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
            $productoProveedore->setProveedorId($this);
        }

        return $this;
    }

    public function removeProductoProveedore(ProductoProveedores $productoProveedore): static
    {
        if ($this->productoProveedores->removeElement($productoProveedore)) {
            // set the owning side to null (unless already changed)
            if ($productoProveedore->getProveedorId() === $this) {
                $productoProveedore->setProveedorId(null);
            }
        }

        return $this;
    }
}
