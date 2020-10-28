<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_id',
        'pupil_id',
        'mark',
        'teacher_id'
    ];

    public function pupil()
    {
        return $this->belongsTo(Pupil::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Worker::class, 'teacher_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
