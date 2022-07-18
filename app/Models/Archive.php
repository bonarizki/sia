<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Archive extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];
    protected $fillable = [];
    protected $with = ['Departments'];

    public function Departments()
    {
        return $this->hasOne(Departments::class,'id','department_id');
    }
}
