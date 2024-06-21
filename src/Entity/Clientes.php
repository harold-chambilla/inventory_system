<?php

namespace App\Entity;

use App\Repository\ClientesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientesRepository::class)]
class Clientes
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
     * @var Collection<int, Ventas>
     */
    #[ORM\OneToMany(targetEntity: Ventas::class, mappedBy: 'cliente_id')]
    private Collection $ventas;

    public function __construct()
    {
        $this->ventas = new ArrayCollection();
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
     * @return Collection<int, Ventas>
     */
    public function getVentas(): Collection
    {
        return $this->ventas;
    }

    public function addVenta(Ventas $venta): static
    {
        if (!$this->ventas->contains($venta)) {
            $this->ventas->add($venta);
            $venta->setClienteId($this);
        }

        return $this;
    }

    public function removeVenta(Ventas $venta): static
    {
        if ($this->ventas->removeElement($venta)) {
            // set the owning side to null (unless already changed)
            if ($venta->getClienteId() === $this) {
                $venta->setClienteId(null);
            }
        }

        return $this;
    }
}
