<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RoleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $customerRoles=new Role();
        $customerRoles->setLabel("customer");
        $manager->persist($customerRoles);

        $collaboratorRoles=new Role();
        $collaboratorRoles->setLabel("collaborator");
        $manager->persist($collaboratorRoles);

        $localRole=new Role();
        $localRole->setLabel("local administrator");
        $manager->persist($localRole);

        $powerUser=new Role();
        $powerUser->setLabel("Power user");
        $manager->persist($powerUser);

        $superUser=new Role();
        $superUser->setLabel("super user");
        $manager->persist($superUser);

        $manager->flush();
    }
}
