<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

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

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class, 'student_id', 'ag');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'student_id', 'ag');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'enrollments', 'student_id', 'subject_id');
    }

    public function calculateAverage($subject)
    {
        $tasks = Task::query()->where('subject_id', $subject)->get();
        $values = 0;
        $weighted = 0;
        foreach ($tasks as $task){
            $grades = $task->grades()->where('student_id', Auth::user()->student()->first()->ag)->first();
            $values += ($grades->value??0)*$task->weighted;
            $weighted += $task->weighted;
        }
        return $values/$weighted;
    }

    public function getEmailAttribute()
    {
        return $this->user->email;
    }

    public function getUserAttribute()
    {
        return $this->user()->first();
    }

    public function getEntryDateFmtAttribute(): string
    {
        return Carbon::make($this->entry_date)->format('d/m/Y');
    }

    public function geBbornDateFmtAttribute(): string
    {
        return Carbon::make($this->born_date)->format('d/m/Y');
    }

    public function scopeWhereCourse($query, $courses = []): Builder
    {
        if($courses != []){
            return $query->whereIn('course_id', is_array($courses)?$courses:[$courses]);
        }else{
            return $query;
        }
    }

    public function scopeRangeEntryDate($query, $initialDate = '', $finalDate = ''): Builder
    {
        if($initialDate != ''){
            $query = $query->whereDate('entry_date', '>=', $initialDate);
        }
        if($finalDate != ''){
            $query = $query->whereDate('entry_date', '<=', $finalDate);
        }
        return $query;
    }

    public function scopeRangeBornDate($query, $initialDate = '', $finalDate = ''): Builder
    {
        if($initialDate != ''){
            $query = $query->whereDate('entry_date', '>=', $initialDate);
        }
        if($finalDate != ''){
            $query = $query->whereDate('entry_date', '<=', $finalDate);
        }
        return $query;
    }

    public function isRegistered(): bool
    {
        if(Auth::user()->level == 2){
            if(Auth::user()->student()->first()->enrollments()->join('subjects', 'subject_id', '=', 'subjects.id')->where('term', term_now())->get()->count() > 0){
                return true;
            }
            return false;
        }
        return false;
    }
}
