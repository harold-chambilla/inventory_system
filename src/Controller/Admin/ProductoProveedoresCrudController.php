<?php

namespace App\Controller\Admin;

use App\Entity\ProductoProveedores;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductoProveedoresCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductoProveedores::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            AssociationField::new('producto_id', 'Producto'),
            AssociationField::new('proveedor_id', 'Proveedor'),
            IntegerField::new('precio_proveedor'),
        ];
    }
}
