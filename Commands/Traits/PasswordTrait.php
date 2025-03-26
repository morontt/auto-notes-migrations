<?php

/**
 * User: morontt
 * Date: 26.03.2025
 * Time: 20:44
 */

namespace AutoNotes\Commands\Traits;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

trait PasswordTrait
{
    public function passwordHasher(): PasswordHasherInterface
    {
        $factory = new PasswordHasherFactory([
            'common' => [
                'algorithm' => 'bcrypt',
                'cost' => 12,
            ],
        ]);

        return $factory->getPasswordHasher('common');
    }
}
