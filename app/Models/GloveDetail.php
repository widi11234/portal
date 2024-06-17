<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class GloveDetail extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'glove_id',
        'description',
        'delivery',
        'c1',
        'c1_scientific',
        'judgement',
        'remarks',
    ];

    /**
     * Get the glove that owns the detail.
     */
    public function glove()
    {
        return $this->belongsTo(Glove::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'glove_id',
            'description',
            'delivery',
            'c1',
            'c1_scientific',
            'judgement',
            'remarks'
        ]);
    }
}
