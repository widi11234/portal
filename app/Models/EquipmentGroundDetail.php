<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class EquipmentGroundDetail extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'equipment_ground_id',
        'area',
        'location',
        'measure_results_ohm',
        'judgement_ohm',
        'measure_results_volts',
        'judgement_volts',
        'remarks',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['equipment_ground_id', 'area', 'location', 'measure_results_ohm', 'judgement_ohm','measure_results_volts', 'judgement_volts', 'remarks']);
    }

    public function equipmentGround()
    {
        return $this->belongsTo(EquipmentGround::class);
    }

}
