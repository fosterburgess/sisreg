<?php

namespace App\Models\Reg;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function instance()
    {
        return $this->belongsTo(Instance::class);
    }
}
