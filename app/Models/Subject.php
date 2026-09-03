<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}