<?php

namespace App\Filament\Teacher\Resources\Courses\RelationManagers;

use App\Filament\Teacher\Resources\Courses\CourseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class EnrollmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'enrollments';

    protected static ?string $relatedResource = CourseResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => 
                $query->with(['student', 'course.teachers'])
                    ->whereHas('course', fn($q)=>$q->where('is_active', true))
            )
            ->columns([
                // Your columns, for example:
                TextColumn::make('student.name')
                    ->label('Student'),
                TextColumn::make('enrollments.grade')
                    ->label('Grade')
                    ->default('0.00'),
                TextColumn::make('status')
                        ->badge(),
            ])
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
