<?php

namespace App\Policies;

class AdministratorPolicy extends CorePolicy
{
    /**
     * @var string
     */
    protected static string $key = 'administrator';
}
