<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class FlooringDetail extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['flooring_id', 'area', 'location', 'b1', 'b1_scientific', 'judgement', 'remarks'];

    public function flooring()
    {
        return $this->belongsTo(Flooring::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['flooring_id', 'area', 'location', 'b1', 'b1_scientific', 'judgement', 'remarks']);
    }
}