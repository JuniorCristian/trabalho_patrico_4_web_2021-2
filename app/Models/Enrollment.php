<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Enrollment extends Model
{
    use HasFactory;

    protected $primaryKey = ['student_id', 'subject_id'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'locked'
    ];

    public function students(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'ag');
    }

    public function lock()
    {
        $this->attributes['locked'] = 1;
        dd($this);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function scopeStudent($query, $ag = null)
    {
        if($ag !== null){
            return $query->where('student_id', $ag);
        }
        return $query;
    }
}
