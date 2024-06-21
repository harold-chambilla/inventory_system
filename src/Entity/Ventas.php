<?php

namespace App\Entity;

use App\Repository\VentasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VentasRepository::class)]
class Ventas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $total = null;

    /**
     * @var Collection<int, DetallesVenta>
     */
    #[ORM\OneToMany(targetEntity: DetallesVenta::class, mappedBy: 'venta_id')]
    private Collection $detallesVentas;

    #[ORM\ManyToOne(inversedBy: 'ventas')]
    private ?Clientes $cliente_id = null;

    public function __construct()
    {
        $this->detallesVentas = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(?string $total): static
    {
        $this->total = $total;

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
            $detallesVenta->setVentaId($this);
        }

        return $this;
    }

    public function removeDetallesVenta(DetallesVenta $detallesVenta): static
    {
        if ($this->detallesVentas->removeElement($detallesVenta)) {
            // set the owning side to null (unless already changed)
            if ($detallesVenta->getVentaId() === $this) {
                $detallesVenta->setVentaId(null);
            }
        }

        return $this;
    }

    public function getClienteId(): ?Clientes
    {
        return $this->cliente_id;
    }

    public function setClienteId(?Clientes $cliente_id): static
    {
        $this->cliente_id = $cliente_id;

        return $this;
    }
}
