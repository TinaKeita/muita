<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parties extends Model
{
    use HasFactory;

    protected $table = 'parties';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'type',
        'name',
        'active',
        'vat',
        'country',
        'email',
        'phone',
    ];
}
