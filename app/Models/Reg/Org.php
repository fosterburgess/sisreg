<?php

namespace App\Models\Reg;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Org extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ORG_LEVEL_TYPE_STATE = 'state';
    public const ORG_LEVEL_TYPE_COUNTY = 'county';
    public const ORG_LEVEL_TYPE_DISTRICT = 'district';
    public const ORG_LEVEL_TYPE_VIRTUAL = 'virtual';
    public const ORG_LEVEL_TYPE_SCHOOL = 'school';
    public const ORG_LEVEL_TYPE_PRIVATE = 'private';
    public const ORG_LEVEL_TYPE_CUSTOM = 'custom';

    protected $guarded = ['id'];
    public function parent()
    {
        return $this->belongsTo(Org::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Org::class, 'parent_id','id');
    }

    public function schools()
    {
        return $this->hasMany(School::class, 'org_id', 'id');
    }
}
