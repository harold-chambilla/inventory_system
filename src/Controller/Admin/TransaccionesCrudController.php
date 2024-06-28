<?php

namespace App\Controller\Admin;

use App\Entity\Transacciones;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class TransaccionesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Transacciones::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Transacción')
            ->setEntityLabelInPlural('Transacciones')
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
            TextField::new('tipo'),
            DateTimeField::new('fecha'),
            IntegerField::new('cantidad'),
            AssociationField::new('producto_id', 'Producto'),
            AssociationField::new('proveedor_id', 'Proveedor'),
        ];
    }
}
