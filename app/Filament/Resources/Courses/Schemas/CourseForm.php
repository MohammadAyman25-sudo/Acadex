<?php

namespace App\Filament\Resources\Courses\Schemas;

use App\Models\Teacher;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
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
                Select::make('department_id')
                    ->label('Department')
                    ->relationship('department', 'name')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set) => $set('teachers', [])),
                Select::make('teachers')
                    ->label('Teachers')
                    ->multiple()
                    ->relationship('teachers', 'id')
                    ->preload()
                    ->searchable()
                    ->reactive()
                    ->options(function (callable $get) {
                        $department = $get('department_id');

                        $query = Teacher::query()
                                    -> with('user')
                                    -> whereHas('user')
                                    -> when($department, fn($q) => $q->where('department_id', $department));
                        
                        return $query
                                ->get()
                                ->mapWithKeys(fn($teacher) => [$teacher->id => $teacher->user->name])
                                ->toArray();
                    }),
                     //->getOptionLabelUsing(fn($value) => Teacher::with('user')->find($value)?->user?->name),
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
