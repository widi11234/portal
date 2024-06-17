<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SolderingDetail extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'soldering_id',
        'area',
        'location',
        'e1',
        'judgement',
        'remarks'
    ];

    public function soldering()
    {
        return $this->belongsTo(Soldering::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'soldering_id',
            'area',
            'location',
            'e1',
            'judgement',
            'remarks'
        ]);
    }
}
