<?php

namespace App\Models\Reg;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function org()
    {
        return $this->belongsTo(Org::class);
    }

    public function instances()
    {
        return $this->hasMany(Instance::class);
    }
}
