<?php

namespace App\Controller\Admin;

use App\Entity\Productos;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductosCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Productos::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('nombre'),
            TextEditorField::new('descripcion'),
            AssociationField::new('categoria_id', 'Categoria')
        ];
    }
    
}
