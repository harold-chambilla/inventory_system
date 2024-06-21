<?php

namespace App\Controller\Admin;

use App\Entity\Categorias;
use App\Entity\Clientes;
use App\Entity\DetallesVenta;
use App\Entity\ProductoProveedores;
use App\Entity\Productos;
use App\Entity\Proveedores;
use App\Entity\Transacciones;
use App\Entity\Ventas;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(CategoriasCrudController::class)->generateUrl());
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Sistema de inventario');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::section('Categorias');
        yield MenuItem::linkToCrud('Categorias', 'fa-solid fa-list', Categorias::class);
        yield MenuItem::linkToCrud('Productos', 'fa-solid fa-shop', Productos::class);  
        yield MenuItem::linkToCrud('Proveedores', 'fa-solid fa-user-tie', Proveedores::class); 
        yield MenuItem::linkToCrud('Clientes', 'fas fa-user', Clientes::class);
        yield MenuItem::linkToCrud('Transacciones', 'fa-solid fa-handshake', Transacciones::class);
        yield MenuItem::linkToCrud('Ventas', 'fa-solid fa-check', Ventas::class);
        yield MenuItem::linkToCrud('Producto de Proveedores', 'fa-solid fa-truck-field', ProductoProveedores::class);
        yield MenuItem::linkToCrud('Detalles de Ventas', 'fa-solid fa-circle-info', DetallesVenta::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
