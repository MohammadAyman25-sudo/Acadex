<?php

namespace App\Filament\Teacher\Resources\Courses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Schemas\Components\Tabs\Tab;

class CoursesTable
{

    public static function table(Table $table): Table
    {
        return $table->modifyQueryUsing(fn(Builder $query) => $query->forTeacher(auth()->user()->teacher->id))
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
        ])
        ->recordActions([
            ViewAction::make(),
        ]);
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'active' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('active', true)),
            'inactive' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('active', false)),
        ];
    }

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('code')
                    ->searchable(),
                TextColumn::make('department_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('credits')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
