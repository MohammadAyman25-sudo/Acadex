<?php

namespace App\Filament\Resources\Enrollments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EnrollmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('student_id')
                    ->required(),
                TextInput::make('course_id')
                    ->required()
                    ->numeric(),
                TextInput::make('grade')
                    ->numeric()
                    ->default(null),
                Select::make('status')
                    ->options([
            'enrolled' => 'Enrolled',
            'in_progress' => 'In progress',
            'completed' => 'Completed',
            'failed' => 'Failed',
            'withdrawn' => 'Withdrawn',
        ])
                    ->default('in_progress')
                    ->required(),
            ]);
    }
}
