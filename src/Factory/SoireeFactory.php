<?php

namespace App\Factory;

use App\Entity\Soiree;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class SoireeFactory extends PersistentProxyObjectFactory
{
    protected static function getClass(): string
    {
        return Soiree::class;
    }

    protected function defaults(): array
    {
        return [
            'titre' => self::faker()->sentence(3),
            'dateSoiree' => self::faker()->dateTimeBetween('+1 week', '+2 years'),
            'dateCreation' => new \DateTimeImmutable(),
        ];
    }
}