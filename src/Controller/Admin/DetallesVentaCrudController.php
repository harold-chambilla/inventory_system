<?php

namespace App\Controller\Admin;

use App\Entity\DetallesVenta;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class DetallesVentaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DetallesVenta::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Detalle de Venta')
            ->setEntityLabelInPlural('Detalles de Venta')
            ->setDefaultSort(['id' => 'DESC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('venta_id')) // Filtro por venta
            ->add(EntityFilter::new('producto_id')); // Filtro por producto
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Ocultar en el formulario de creación/edición
            AssociationField::new('venta_id', 'Venta'),
            AssociationField::new('producto_id', 'Producto'),
            IntegerField::new('cantidad'),
            IntegerField::new('precio_unitario'),
            IntegerField::new('subtotal'),
        ];
    }
}
