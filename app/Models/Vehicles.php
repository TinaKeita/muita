<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicales extends Model
{
    use HasFactory;

    protected $table = 'vehicles';
    public $incrementing = false; 
        
    protected $fillable = [
        'id',
        'plate_no',
        'country',
        'make',
        'model',
        'vin'
    ];
}
