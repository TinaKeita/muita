<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inspection extends Model
{
    use HasFactory;

    protected $table = 'inspections';
    public $incrementing = false; 
        
    protected $fillable = [
        'id',
        'case_id',
        'type',
        'requested_by',
        'start_ts',
        'location',
        'checks',
        'assigned_to',
    ];

    protected $casts = [
        'checks' => 'array',
    ];
    
    public function case() {
        return $this->belongsTo(CustomsCase::class, 'case_id');
    }

    public function inspector() {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    protected $attributes = [
    'assigned_to' => 'unassigned',
    ];

}
