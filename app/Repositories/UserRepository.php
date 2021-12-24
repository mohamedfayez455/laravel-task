<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

    // store new user in database
    public function storeUser($data)
    {
        return User::create([
            'name' => $data->name,
            'email' => $data->email,
            'google_id' => $data->id,
        ]);
    }

}
