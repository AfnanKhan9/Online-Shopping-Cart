<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    
    protected $table = "feedback"; // your table name

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message'
    ];
}
