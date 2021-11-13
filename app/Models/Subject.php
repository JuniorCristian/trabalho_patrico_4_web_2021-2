<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_unit_id',
        'teacher_id',
        'term'
    ];

    public function course_unit(): BelongsTo
    {
        return $this->belongsTo(CourseUnit::class, 'course_unit_id', 'id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'enrollments', 'subject_id', 'student_id');
    }

    public function getCourseUnitNameAttribute()
    {
        return $this->course_unit()->first()->name;
    }

    public function getTermFormateAttribute(): string
    {
        $term = explode('-', $this->term);
        return $term[1] . '/' . $term[0];
    }

    public function getTeacherNameAttribute()
    {
        return $this->teacher()->first()->name;
    }

    public function setTermAttribute($term)
    {
        $term = explode('/', $term);
        $term = $term[1] . '-' . $term[0];
        $this->attributes['term'] = $term;
    }

    public function scopeIsTeacher($query, $teacher)
    {
        if (Auth::user()->level === 2) {
            return $query->where('teacher_id', $teacher);
        } else {
            return $query;
        }
    }

    public function scopeWhereTerm($query, $term = [])
    {
        if($term != '') {
            if (!is_array($term)) {
                $term = [$term];
            }elseif($term == []){
                $term = [term_now()];
            }
            return $query->whereIn('term', $term);
        }
        return $query;
    }

}
