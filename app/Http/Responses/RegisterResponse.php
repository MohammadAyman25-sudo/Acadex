<?php

namespace App\Http\Responses;

use Filament\Auth\Http\Responses\Contracts\RegistrationResponse as RegistrationResponse;

class RegisterResponse implements RegistrationResponse {

    public function toResponse($request) {
        return redirect()->route('filament.teacher.auth.email-verification.prompt');
    }
}