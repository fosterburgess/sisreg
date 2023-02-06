<?php

namespace App\Models\Reg;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function timePeriod()
    {
        return $this->belongsTo(TimePeriod::class);
    }
}
