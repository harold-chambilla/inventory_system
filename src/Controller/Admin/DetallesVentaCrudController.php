<?php

namespace App\Controller\Admin;

use App\Entity\DetallesVenta;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DetallesVentaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DetallesVenta::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            AssociationField::new('venta_id', 'Ventas'),
            AssociationField::new('producto_id', 'Producto'),
            IntegerField::new('cantidad'),
            IntegerField::new('precio_unitario'),
            IntegerField::new('subtotal'),
        ];
    }
}
