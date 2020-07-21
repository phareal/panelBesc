<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Repository\RoleRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ControlesFixTure extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder,RoleRepository $roleRepository)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->roleRepository = $roleRepository;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $admin=new Admin();
        $admin->setUsername('controle@cncb.bj');
        $admin->setPassword($this->userPasswordEncoder->encodePassword($admin,'controle@cncb.bj'));
        $admin->setRole($this->roleRepository->find(12));
        $manager->persist($admin);
        $manager->flush();
    }
}
