<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Document;

class CustomsCase extends Model
{
     use HasFactory;

    protected $table = 'cases';
    public $incrementing = false; 

    protected $fillable = [
        'id',
        'external_ref',
        'status',
        'priority',
        'arrival_ts',
        'checkpoint_id',
        'origin_country',
        'destination_country',
        'risk_flags',
        'declarant_id',
        'consignee_id',
        'vehicle_id',
    ];

public function documents()
    {
        // pieliek speciāli case_id kā ārējo atslēgu
        return $this->hasMany(Document::class, 'case_id');
    }
}
