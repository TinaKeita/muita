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
    public static function generateId()
    {
        $last = self::orderBy('id', 'desc')->first();

        if (!$last) {
            return 'doc-000001';
        }

        $num = intval(substr($last->id, 4)) + 1;
        return 'doc-' . str_pad($num, 6, '0', STR_PAD_LEFT);
    }

}
