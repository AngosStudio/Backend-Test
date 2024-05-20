<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Models\User;

class UserRepository
{
    public function create(array $data)
    {
        return User::create($data);
    }

    public function findById($id)
    {
        return User::find($id);
    }

    public function getByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
