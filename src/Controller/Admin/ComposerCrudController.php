<?php

namespace App\Controller\Admin;

use App\Entity\Composer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ComposerCrudController extends AbstractCrudController
{   private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }
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
            ImageField::new('picture')
            ->setUploadDir('public/images/')
            ->setBasePath($this->params->get('app.path.composer_images'))
            ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
            ->setRequired(false)
            ->hideWhenUpdating(),
            AssociationField::new('category'),
            
        ];
    }
    
}
