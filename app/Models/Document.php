<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';
    public $incrementing = false; 

    protected $fillable = [
        'id',
        'case_id',
        'filename',
        'mime_type',
        'category',
        'pages',
        'uploaded_by',
    ];

    public function case()
        {
            return $this->belongsTo(CustomsCase::class);
        }
}
