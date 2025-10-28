<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TeacherInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('user_id'),
                TextEntry::make('user.name')
                    ->label('Name'),
                TextEntry::make('user.email')
                    ->label('Email'),
                TextEntry::make('department_id')
                    ->numeric(),
                TextEntry::make('department.name')
                    ->label('Department Name'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('deleted_at')
                    ->dateTime(),
            ]);
    }
}
