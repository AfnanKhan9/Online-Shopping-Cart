<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // <- extend this
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'phone', 'address'];
}
