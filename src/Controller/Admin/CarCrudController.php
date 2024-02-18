<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use NumberFormatter;

class CarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Car::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'Identifiant');
        yield TextField::new('brand', 'Marque');
        yield TextField::new('model', 'Model');
        yield NumberField::new('year', 'Année')
            ->setNumberFormat('%d');
        yield NumberField::new('price', 'Prix')
            ->formatValue(fn ($val) => (new NumberFormatter( 'fr_FR', NumberFormatter::CURRENCY ))->formatCurrency($val, 'EUR'));
        yield DateField::new('createdAt', 'Date de création');
    }
}
