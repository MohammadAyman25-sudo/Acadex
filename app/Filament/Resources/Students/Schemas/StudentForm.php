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
                TextInput::make('user.name')
                    ->required()
                    ->formatStateUsing(fn ($record) => $record?->user?->name)
                    ->dehydrateStateUsing(fn ($state, $record) => $state)
                    ->afterStateUpdated(function ($state, $record) {
                                            if ($record?->user) {
                                                $record->user->update(['name' => $state]);
                                            }
                                        }),
                TextInput::make('user.email')
                    ->required()
                    ->formatStateUsing(fn($record) => $record?->user?->email)
                    ->dehydrateStateUsing(fn($state, $record) => $state)
                    ->afterStateUpdated(function ($state, $record) {
                        if ($record?->user) {
                            $record->user->update(['email' => $state]);
                        }
                    }),
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
