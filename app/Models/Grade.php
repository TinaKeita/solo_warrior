<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['user_id', 'subject_id', 'grade', 'graded_at'];

    // Saistība ar studentu
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Saistība ar priekšmetu
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
