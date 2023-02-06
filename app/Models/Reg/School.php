<?php

namespace App\Models\Reg;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Org
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $attributes = ['level_type'=>Org::ORG_LEVEL_TYPE_SCHOOL];

    public function org()
    {
        return $this->belongsTo(Org::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
