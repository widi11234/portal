<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class GarmentDetail extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'garment_id',
        'name',
        'd1',
        'd1_scientific',
        'judgement_d1',
        'd2',
        'd2_scientific',
        'judgement_d2',
        'd3',
        'd3_scientific',
        'judgement_d3',
        'd4',
        'd4_scientific',
        'judgement_d4',
        'remarks',
    ];

    public function garment()
    {
        return $this->belongsTo(Garment::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'garment_id',
            'name',
            'd1',
            'd1_scientific',
            'judgement_d1',
            'd2',
            'd2_scientific',
            'judgement_d2',
            'd3',
            'd3_scientific',
            'judgement_d3',
            'd4',
            'd4_scientific',
            'judgement_d4',
            'remarks'
        ]);
    }
}
