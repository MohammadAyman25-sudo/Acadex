<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\Student;
use App\Models\Teacher;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordUpdate(\Illuminate\Database\Eloquent\Model $record, array $data): \Illuminate\Database\Eloquent\Model
    {
        if (isset($data['role']) && $data['role'] !== $record->getAttribute('role')) {
            if ($data['role'] === 'teacher') {
                Teacher::create([
                    'user_id' => $record->getAttribute('id'),
                ]);
            }
            if ($data['role'] === 'student') {
                Student::create([
                    'user_id' => $record->getAttribute('id'),
                ]);
            }
            if ($data['role'] === 'admin') {
                if ($record->getAttribute('role') === 'student') {
                    Student::where('user_id', $record->getAttribute('id'))->delete();
                } else if ($record->getAttribute('role') === 'teacher') {
                    Teacher::where('user_id', $record->getAttribute('id'))->delete();
                }
            }
        }
        if (!isset($data['password']) || empty($data['password'])) {
            $data['password'] = $record->getAttribute('password');
        }
        $record->update($data);
        return $record;
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
