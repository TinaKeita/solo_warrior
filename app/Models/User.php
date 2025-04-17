<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Masīvs ar lauciņiem, kurus drīkst masveidā piešķirt (`mass assignable`).
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'role',
        'email',
        'password',
    ];

    /**
     * Lauki, kas jāslēpj, kad modelis tiek serializēts (piemēram, JSON atbildēs).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Lauki, kas jātransformē uz konkrētu tipu.
     */
    protected $casts = [
        'birth_date' => 'date',
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Laravel >=10 automātiski hešo
    ];

    public function grades()
    {
        return $this->hasMany(Grade::class, 'user_id');
    }
}
