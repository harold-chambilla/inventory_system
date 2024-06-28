<?php

namespace App\Twig\Components;

use App\Repository\ProductosRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;


#[AsLiveComponent('list_product')]
final class ListProductComponent
{
    use DefaultActionTrait;

    private ProductosRepository $repo;

    #[LiveProp]
    public bool $expanded = false;

    public function __construct(ProductosRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getProductos(): array
    {
        return $this->repo->findAll();
    }
}
