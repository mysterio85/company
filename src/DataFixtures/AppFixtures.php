<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 10; $i++) {
            $alphabet="abcdefghijklmnopqrstuvwxyz";
            $company = new Company();
            $company->setAddress($i.' Rue du  '.substr($alphabet, rand(2,10), rand(6,10)) ." Lyon France");
            $company->setName(substr($alphabet, rand(1,20), rand(5,10)));
            $company->setCompanyNumber(rand(400,10)+2784+$i);
            $manager->persist($company);
            $manager->flush();
            $companyObject = $company;

            for ($a = 0; $a < 10; $a++) {
                $user = new User();
                $user->setCompany($companyObject);
                $user->setFirstName(substr($alphabet.$alphabet, rand(2,20)));
                $user->setLastName(substr($alphabet.$alphabet, rand(7,20)));
                $manager->persist($user);
                $manager->flush();
            }

        }

    }
}
