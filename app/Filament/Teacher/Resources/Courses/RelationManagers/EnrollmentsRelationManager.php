<?php

namespace App\Filament\Teacher\Resources\Courses\RelationManagers;

use App\Filament\Teacher\Resources\Courses\CourseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class EnrollmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'enrollments';

    protected static ?string $relatedResource = CourseResource::class;

    protected static bool $shouldInheritParentQueryConstraints = false;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
