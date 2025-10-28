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
                TextInput::make('student_name')
                    ->label('Student Name')
                    ->required()
                    ->disabled()
                    ->formatStateUsing(fn($set, $record) => $set('student_name', $record?->student?->user?->name)),
                TextInput::make('course')
                    ->label('Course Name')
                    ->required()
                    ->disabled()
                    ->formatStateUsing(fn($set, $record) => $set('course', $record?->course?->name)),
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
