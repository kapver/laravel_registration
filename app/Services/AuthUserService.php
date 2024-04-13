<?php

namespace App\Services;

use App\Models\User;
use App\Events\UserRegistered;
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

        $user->phoneBook()->create([
            'phone_number' => $data['phone_number'],
        ]);

        $user->userCountry()->create([
            'user_id' => $user->id,
            'country_id' => $data['country_id'],
        ]);

        $user->fresh();

        // direct notification
        $user->notify(new \App\Notifications\UserRegistered());

        // or using UserRegistered event
        // UserRegistered::dispatch($user);

        return $user;
    }
}