<?php

namespace App\Controller\Admin;

use App\Entity\Composer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ComposerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Composer::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           // IdField::new('id'),
            TextField::new('name'),
            TextEditorField::new('description'),
            TextField::new('price'),
            TextField::new('stock'),
            TextField::new('type'),
            TextField::new('picture'),
            AssociationField::new('category'),
            
        ];
    }
    
}
