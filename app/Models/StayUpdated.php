<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StayUpdated extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'email',
    ];
    
    protected $table = 'stay_updated';
}
