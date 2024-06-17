<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Packaging extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable =['register_no','status'];

    public function packagingDetails()
    {
        return $this->hasMany(packagingDetail::class);
    }

    public function getJudgementCountsAttribute()
    {
        $okCount = PackagingDetail::where('packaging_id', $this->id)->where('judgement', 'OK')->count();
        $ngCount = PackagingDetail::where('packaging_id', $this->id)->where('judgement', 'NG')->count();

        return [
            'ok' => $okCount,
            'ng' => $ngCount
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['register_no','status']);
    }
}
