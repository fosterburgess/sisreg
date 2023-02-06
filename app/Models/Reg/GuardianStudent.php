<?php

namespace App\Models\Reg;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GuardianStudent extends Pivot
{

    protected $table = 'guardian_student';

    public $incrementing = true;

    public function student()
    {
        return $this->hasOne(Student::class);
    }
    public function guardian()
    {
        return $this->hasOne(Guardian::class);
    }
}
