<?php

namespace App\Factory;

use App\Entity\Soiree;
use Zenstruck\Foundry\Factory;

final class SoireeFactory extends Factory
{
    protected function getDefaults(): array
    {
        return [
            'titre' => self::faker()->sentence(3),
            'dateSoiree' => \DateTimeImmutable::createFromMutable(
                self::faker()->dateTimeBetween('+1 week', '+2 years')
            ),
            'dateCreation' => new \DateTimeImmutable(),
        ];
    }

    protected static function getClass(): string
    {
        return Soiree::class;
    }
}