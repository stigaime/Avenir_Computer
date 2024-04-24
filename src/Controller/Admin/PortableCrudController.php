<?php

namespace App\Controller\Admin;

use App\Entity\Portable;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PortableCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Portable::class;
    }

    
    //public function configureFields(string $pageName): iterable
    //{
       // return [
           
         //   TextField::new('title'),
           // TextField::new('price'),
            //TextField::new('stock'),
            //TextEditorField::new('description'),
            //ImageField::new('picture')->setUploadDir('public/images/portables'),
        //];
    //}
    
}
