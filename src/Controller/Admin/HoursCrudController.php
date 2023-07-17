<?php

namespace App\Controller\Admin;

use App\Entity\Hours;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class HoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hours::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Day_of_week'),
            TimeField::new('Open_am'),
            TimeField::new('Close_am'),
            TimeField::new('Open_pm'),
            TimeField::new('Close_pm')
        ];
    }    
}
