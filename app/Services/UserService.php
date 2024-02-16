<?php

namespace App\Services;

use App\Models\User;

class UserService
{

    /**
     * @param array $data
     * @return User|false
     */
    public static function create(array $data): User|false
    {
        return User::create($data);
    }
}
