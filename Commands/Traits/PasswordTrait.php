<?php

/**
 * User: morontt
 * Date: 26.03.2025
 * Time: 20:44
 */

namespace AutoNotes\Commands\Traits;

use Symfony\Component\PasswordHasher\Hasher\MessageDigestPasswordHasher;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

trait PasswordTrait
{
    public function passwordHasher(): PasswordHasherInterface
    {
        return new MessageDigestPasswordHasher('sha384', true, 4600);
    }
}
