<?php

namespace App\DataFixtures;

use App\Entity\Soiree;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $soiree = new Soiree();
        $soiree->setTitre("Noël");
        $soiree->setDateSoiree(new \DateTimeImmutable('2026-12-24'));
        $soiree->setDateCreation(new \DateTimeImmutable());

        $manager->persist($soiree);

        $manager->flush();
    }
}