<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Flooring extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['register_no', 'area', 'location'];

    public function flooringDetails()
    {
        return $this->hasMany(FlooringDetail::class);
    }

    public function getJudgementCountsAttribute()
    {
        $okCount = FlooringDetail::where('flooring_id', $this->id)->where('judgement', 'OK')->count();
        $ngCount = FlooringDetail::where('flooring_id', $this->id)->where('judgement', 'NG')->count();

        return [
            'ok' => $okCount,
            'ng' => $ngCount
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['register_no', 'area', 'location']);
    }
}
