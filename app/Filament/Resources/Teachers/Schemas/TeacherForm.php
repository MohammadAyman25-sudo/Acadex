<?php

namespace App\Filament\Resources\Teachers\Schemas;

use App\Models\Department;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user.name')
                    ->required()
                    ->formatStateUsing(fn($record) => $record?->user?->name)
                    ->dehydrateStateUsing(fn($state, $record) => $state)
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
                Select::make("department_id")
                    ->label('Department')
                    ->options(fn() => Department::pluck('name', 'id'))
                    ->preload()
                    ->default(null),
                
            ]);
    }
}
