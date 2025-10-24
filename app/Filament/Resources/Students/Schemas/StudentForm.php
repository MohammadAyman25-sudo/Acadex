<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required(),
                Select::make('year_level')
                    ->options([
            'freshman' => 'Freshman',
            'sophomore' => 'Sophomore',
            'junior' => 'Junior',
            'senior' => 'Senior',
        ])
                    ->default('freshman')
                    ->required(),
            ]);
    }
}
