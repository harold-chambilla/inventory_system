<?php

namespace App\Controller;

use App\Repository\ProductosRepository;
use App\Repository\TransaccionesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TransparenciaController extends AbstractController
{
    #[Route('/', name: 'app_transparencia')]
    public function index(ProductosRepository $productosRepository, TransaccionesRepository $transaccionesRepository): Response
    {
        $productos = $productosRepository->findAll();
        $transaciones = $transaccionesRepository->findAll();
        return $this->render('transparencia/index.html.twig', [
            'products' => $productos,
            'transacciones' => $transaciones
        ]);
    }
}
