<?php

namespace App\Filament\Teacher\Resources\Courses;

use App\Filament\Teacher\Resources\Courses\Pages\CreateCourse;
use App\Filament\Teacher\Resources\Courses\Pages\EditCourse;
use App\Filament\Teacher\Resources\Courses\Pages\ListCourses;
use App\Filament\Teacher\Resources\Courses\Pages\ViewCourse;
use App\Filament\Teacher\Resources\Courses\Schemas\CourseForm;
use App\Filament\Teacher\Resources\Courses\Schemas\CourseInfolist;
use App\Filament\Teacher\Resources\Courses\Tables\CoursesTable;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use App\Models\Course;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $recordTitleAttribute = 'name';

    

    public static function infolist(Schema $schema): Schema
    {
        return CourseInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table->modifyQueryUsing(
            fn(Builder $query) => $query->leftJoin('course_teacher', 'courses.id', '=', 'course_teacher.course_id')
                ->where('course_teacher.teacher_id', '=', auth()->user()->teacher->id)
                ->latest('courses.created_at')
        )
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('code')
                    ->searchable(),
                TextColumn::make('credits')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCourses::route('/'),
            'view' => ViewCourse::route('/{record}'),
        ];
    }
}
