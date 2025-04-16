<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    protected $fillable = ['first_name', 'last_name'];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
