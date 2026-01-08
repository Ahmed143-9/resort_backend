<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinPilot extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'message',
    ];
    
    protected $table = 'join_pilots';
}
