<?php

namespace App\Filament\Teacher;

use App\Models\User;
use Filament\Auth\Pages\Register as BaseRegistration;

class Register extends BaseRegistration
{
    protected function handleRegistration(array $data): User
    {
        return User::create([
            ...$data,
            'role' => 'teacher',
        ]);
    }
}