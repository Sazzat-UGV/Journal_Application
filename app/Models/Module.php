<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /*relationship with permissions*/
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
