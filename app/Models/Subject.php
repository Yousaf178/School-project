<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'subject_id');
    }
}