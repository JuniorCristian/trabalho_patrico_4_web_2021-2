<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grade extends ModelConfig
{
    use HasFactory;

    protected $primaryKey = ['student_id', 'task_id'];
    public $incrementing = false;

    protected $fillable = [
        'value'
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }

    public function getWeightedAttribute()
    {
        return $this->task()->first()->weighted;
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = str_replace(',', '.', str_replace('.', '', $value));
    }

    public function getValueFmtAttribute()
    {
        return number_format($this->value, '1', ',', '.');
    }
}
