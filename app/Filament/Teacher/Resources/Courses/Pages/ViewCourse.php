<?php

namespace App\Filament\Teacher\Resources\Courses\Pages;

use App\Filament\Teacher\Resources\Courses\CourseResource;
use App\Models\Course;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCourse extends ViewRecord
{
    protected static string $resource = CourseResource::class;
    
    public function getRecord(): Course {
        return static::$resource::getEloquentQuery()
            ->where('courses.id', $this->record->id)
            ->first();
    }

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
