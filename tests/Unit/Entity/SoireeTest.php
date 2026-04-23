<?php

namespace App\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Soiree;
use App\Entity\Dj;
use App\Entity\Materiel;

class SoireeTest extends TestCase
{
    public function testTitre(): void
    {
        // ARRANGE
        $soiree = new Soiree();

        // ACT
        $soiree->setTitre("Noel Party");

        // ASSERT
        $this->assertEquals("Noel Party", $soiree->getTitre());
    }

    public function testAjoutDj(): void
    {
        // ARRANGE
        $soiree = new Soiree();
        $dj = new Dj();

        // ACT
        $soiree->addDj($dj);

        // ASSERT
        $this->assertCount(1, $soiree->getDjs());
        $this->assertSame($dj, $soiree->getDjs()[0]);
    }

    public function testAjoutMateriel(): void
    {
        // ARRANGE
        $soiree = new Soiree();
        $materiel = new Materiel();

        // ACT
        $soiree->addMateriel($materiel);

        // ASSERT
        $this->assertCount(1, $soiree->getMateriels());
        $this->assertSame($materiel, $soiree->getMateriels()[0]);
    }
}