<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table = 'logins'; // table name

    protected $fillable = [
        'name',
        'password',
    ];

    public $timestamps = false; // only if your table has no created_at / updated_at
}