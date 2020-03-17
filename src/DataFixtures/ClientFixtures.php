<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ClientFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $client=new Client();
        $client->setLabel("NET2all");
        $client->setIfu("2345-KF355");
        $client->setPhoneOne("90328783");
        $client->setPhoneTwo("90419152");
        $client->setMail("potchjust@gmail.com");
        $client->setAddress("Attiegou");
        $client->setGps("dsopqweoaosdoapsdsad");
        $client->setEnseigneCol("Net@");
        $client->setUsername("collabo@panelgestion");
        $client->setPassword($this->userPasswordEncoder->encodePassword($client,"collabo@panelgestion"));
        $manager->persist($client);



        $manager->flush();
    }
}
