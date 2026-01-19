<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';   // your table name
    protected $primaryKey = 'id'; // adjust if different
    public $timestamps = false;   // disable if no created_at/updated_at

    protected $fillable = ['name', 'password'];
}
