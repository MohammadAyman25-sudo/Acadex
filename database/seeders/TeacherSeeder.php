<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = Department::all();
        $departmentCount = $departments->count();

        $teachers = Teacher::factory(100)->create();

        $teachers->each(function ($teacher, $index) use ($departments, $departmentCount) {
            $dept = $departments[$index % $departmentCount];
            $teacher->department()->associate($dept);
            $teacher->save();
        });
    }
}
