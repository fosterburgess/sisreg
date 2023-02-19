<?php

namespace App\Models\Reg;

use App\Models\User;
use App\Traits\HasMetadata;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasMetadata;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
