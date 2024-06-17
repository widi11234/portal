<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PackagingDetail extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = ['packaging_id', 'status', 'item', 'f1', 'f1_scientific', 'judgement', 'remarks'];

    public function packaging()
    {
        return $this->belongsTo(Packaging::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['packaging_id', 'status', 'item', 'f1', 'f1_scientific', 'judgement', 'remarks']);
    }
}
