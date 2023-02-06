<?php

namespace App\Models\Reg;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimePeriod extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function instances()
    {
        return $this->hasMany(Instance::class);
    }
}
