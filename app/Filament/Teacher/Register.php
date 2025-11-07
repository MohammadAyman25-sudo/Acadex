<?php

namespace App\Filament\Teacher;

use App\Models\Teacher;
use App\Models\User;
use Filament\Auth\Pages\Register as BaseRegistration;

class Register extends BaseRegistration
{
    protected function handleRegistration(array $data): User
    {
        $user = User::create([
            ...$data,
        ]);
        $user->role = 'teacher';
        $user->save();
        Teacher::create([
            'user_id' => $user->id,
        ]);
        return $user;
    }
}