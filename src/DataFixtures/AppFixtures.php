<?php

namespace App\DataFixtures;

use App\Entity\Soiree;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $soiree = new Soiree();
            $soiree->setTitre('Soirée ' . rand(1, 999));
            $soiree->setDateSoiree(new \DateTimeImmutable('+'.rand(1, 30).' days'));
            $soiree->setDateCreation(new \DateTimeImmutable());

            $manager->persist($soiree);
        }

        $manager->flush();
    }
}