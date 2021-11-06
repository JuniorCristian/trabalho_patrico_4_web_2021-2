<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'ag';
    protected $fillable = [
        'user_id',
        'course_id',
        'name',
        'born_date',
        'entry_date'
    ];

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function grades(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Grade::class, 'student_id', 'ag');
    }

    public function enrollments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Enrollment::class, 'student_id', 'ag');
    }

    public function getEmailAttribute()
    {
        return $this->user->email;
    }

    public function getUserAttribute()
    {
        return $this->user()->first();
    }

    public function scopeWhereCourse($query, $courses = [])
    {
        if($courses != []){
            return $query->whereIn('course_id', is_array($courses)?$courses:[$courses]);
        }else{
            return $query;
        }
    }

    public function scopeRangeEntryDate($query, $initialDate = '', $finalDate = '')
    {
        if($initialDate != ''){
            $query = $query->whereDate('entry_date', '>=', $initialDate);
        }
        if($finalDate != ''){
            $query = $query->whereDate('entry_date', '<=', $finalDate);
        }
        return $query;
    }

    public function scopeRangeBornDate($query, $initialDate = '', $finalDate = '')
    {
        if($initialDate != ''){
            $query = $query->whereDate('entry_date', '>=', $initialDate);
        }
        if($finalDate != ''){
            $query = $query->whereDate('entry_date', '<=', $finalDate);
        }
        return $query;
    }
}
