<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Archive;

class Departments extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function Archive()
    {
        return $this->hasMany(Archive::class, 'department_id', 'id');
    }
}
