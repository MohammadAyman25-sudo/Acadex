<?php

namespace App\Filament\Resources\Enrollments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EnrollmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('student_id'),
                TextEntry::make('course_id')
                    ->numeric(),
                TextEntry::make('grade')
                    ->numeric(),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
