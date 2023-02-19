<?php
namespace App\Services;

use App\Models\Reg\Teacher;

class TeacherService
{

    public function createTeacher(array $validated): Teacher
    {
        $t = new Teacher();
        $t->fill($validated);
        $t->save();
        return $t;
    }
}
