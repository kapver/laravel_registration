<?php

namespace App\Services;

use App\Events\UserRegistered;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthUserService
{
    public function register($data)
    {
        $user = User::firstOrCreate([
            'name'  => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make(''), // consider users don't use passwords
        ]);

        $user->phone()->create([
            'phone_number' => $data['phone_number'],
        ]);

        $user->country()->create([
            'user_id' => $user->id,
            'country_id' => $data['country_id'],
        ]);

        $user->fresh();

        return $user;
    }
}