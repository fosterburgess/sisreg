<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function org()
    {
        return $this->belongsTo(Org::class);
    }
}
