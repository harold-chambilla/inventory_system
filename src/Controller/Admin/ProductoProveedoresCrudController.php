<?php

namespace App\Controller\Admin;

use App\Entity\ProductoProveedores;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class ProductoProveedoresCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductoProveedores::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Producto Proveedor')
            ->setEntityLabelInPlural('Productos Proveedores')
            ->setDefaultSort(['id' => 'DESC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('producto_id')) // Filtro por producto
            ->add(EntityFilter::new('proveedor_id')); // Filtro por proveedor
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Ocultar en el formulario de creación/edición
            AssociationField::new('producto_id', 'Producto'),
            AssociationField::new('proveedor_id', 'Proveedor'),
            IntegerField::new('precio_proveedor'),
        ];
    }
}
