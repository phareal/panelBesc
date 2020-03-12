<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{


    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder=$userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user=new Admin();
        $user->setUsername("panel@gestionbesc.online");


        $user->setPassword($this->userPasswordEncoder->encodePassword($user,"panel@gestionbesc.online"));
        $manager->persist($user);
        $manager->flush();
    }
}
