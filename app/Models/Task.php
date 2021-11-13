<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'name',
        'weighted',
        'initial_date',
        'final_date'
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class, 'task_id', 'id');
    }

    public function scopeTeacher($query)
    {
        if(Auth::user()->level == 1){
            return $query->where('subject_id', Teacher::where('user_id', Auth::id())->first()->subjects()->pluck('subjects.id'));
        }else{
            return $query;
        }
    }

    public function getInitialDateFmtAttribute()
    {
        return Carbon::make($this->initial_date)->format('d/m/Y');
    }

    public function getFinalDateFmtAttribute()
    {
        return Carbon::make($this->final_date)->format('d/m/Y');
    }

    public function getSubjectNameAttribute()
    {
        return $this->subject()->first()->course_unit_name;
    }
}
