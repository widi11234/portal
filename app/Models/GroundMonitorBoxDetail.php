<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class GroundMonitorBoxDetail extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'ground_monitor_box_id',
        'area',
        'location',
        'g1',
        'g2',
        'remarks',
    ];

    public function groundMonitorBox()
    {
        return $this->belongsTo(GroundMonitorBox::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'ground_monitor_box_id',
            'area',
            'location',
            'g1',
            'g2',
            'remarks'
        ]);
    }
}
