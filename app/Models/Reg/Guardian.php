<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guardian extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
