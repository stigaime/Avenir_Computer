<?php

namespace App\Controller\Admin;

use App\Entity\Portable;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class PortableCrudController extends AbstractCrudController
{ private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }
    public static function getEntityFqcn(): string
    {
        return Portable::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           
            TextField::new('title'),
            TextEditorField::new('description'),
            NumberField::new('price'),
            TextField::new('stock'),
            ImageField::new('picture')
            ->setUploadDir('public/images/')
            ->setBasePath($this->params->get('app.path.portable_images'))
            ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
            ->setRequired(false)
            ->hideWhenUpdating(),
        ];
    }
    
}
