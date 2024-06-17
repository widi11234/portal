<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Garment extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable =['nik','name','department'];

    public function garmentDetails()
    {
        return $this->hasMany(GarmentDetail::class);
    }

    // Di dalam model Garment atau model terkait
    public function getJudgementCountsAttribute()
    {
        $okCount = GarmentDetail::where('garment_id', $this->id)
                    ->where(function($query) {
                        $query->where('judgement_d1', 'OK')
                            ->orWhere('judgement_d2', 'OK')
                            ->orWhere('judgement_d3', 'OK')
                            ->orWhere('judgement_d4', 'OK');
                    })
                    ->count();

        $ngCount = GarmentDetail::where('garment_id', $this->id)
                    ->where(function($query) {
                        $query->where('judgement_d1', 'NG')
                            ->orWhere('judgement_d2', 'NG')
                            ->orWhere('judgement_d3', 'NG')
                            ->orWhere('judgement_d4', 'NG');
                    })
                    ->count();

        return [
            'ok' => $okCount,
            'ng' => $ngCount,
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['nik','name','department']);
    }

}
