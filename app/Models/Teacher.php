<?php

namespace App\Models;
use App\Models\Subject;
use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'phone',
    'profile_image',
    'subject_id',
    'class_id',
    'country',
    'status',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    public function schoolClass()
{
    return $this->belongsTo(SchoolClass::class, 'class_id');
}
}