<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        $roleSuperAdmin = new Role();
        $roleSuperAdmin->setWording("super_admin");
        $manager->persist($roleSuperAdmin);

        $roleAdmin = new Role();
        $roleAdmin->setWording("admin");
        $manager->persist($roleAdmin);

        $roleClient = new Role();
        $roleClient->setWording("client");
        $manager->persist($roleClient);

        $superAdmin = new User();
        $superAdmin->setFirstname($faker->firstName());
        $superAdmin->setLastname($faker->lastName());
        $superAdmin->setEmail($faker->email());
        $superAdmin->setRole($roleSuperAdmin);
        $superAdmin->setTelephone($faker->phoneNumber());
        $superAdmin->setPassword($this->encoder->encodePassword($superAdmin, "superadmin"));
        $manager->persist($superAdmin);

        for ($i=0; $i < 5; $i++) { 
            $admin = new User();
            $admin->setFirstname($faker->firstName());
            $admin->setLastname($faker->lastName());
            $admin->setEmail($faker->email());
            $admin->setRole($roleAdmin);
            $admin->setTelephone($faker->phoneNumber());
            $admin->setPassword($this->encoder->encodePassword($admin, "admin"));
            $manager->persist($admin);
        }

        for ($i=0; $i < 30; $i++) { 
            $client = new User();
            $client->setFirstname($faker->firstName());
            $client->setLastname($faker->lastName());
            $client->setEmail($faker->email());
            $client->setRole($roleClient);
            $client->setTelephone($faker->phoneNumber());
            $client->setPassword($this->encoder->encodePassword($client, "client"));
            $manager->persist($client);
        }

        $manager->flush();
    }
}
