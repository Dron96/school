<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'teacher_id'
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class, 'teacher_id');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
