<?php

namespace App\Controller\Admin;

use App\Entity\CarsAd;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CarsAdCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CarsAd::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            MoneyField::new('Price')
                ->setCurrency('EUR'),
            IntegerField::new('Manufacture_year'),
            IntegerField::new('Milage'),
            TextareaField::new('Description'),
            TextField::new('Title_ad'),
            DateField::new('Date_publication'),
            ImageField::new('Ad_illustration')
                ->setBasePath('\uploads')
                ->setUploadDir('public\uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
        ];
    }
    
}
