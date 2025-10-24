<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('code')
                    ->required(),
                TextInput::make('department_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('teacher_id')
                    ->default(null),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('credits')
                    ->required()
                    ->numeric()
                    ->default(3),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
