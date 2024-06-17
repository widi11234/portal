<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Worksurface extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable =['register_no','area','location'];

    public function worksurfaceDetails()
    {
        return $this->hasMany(worksurfaceDetail::class);
    }

    public function getJudgementCountsAttribute()
    {
        $okCount = WorksurfaceDetail::where('worksurface_id', $this->id)
                    ->where(function($query) {
                        $query->where('judgement_a1', 'OK')
                            ->orWhere('judgement_a2', 'OK');
                    })
                    ->count();

        $ngCount = WorksurfaceDetail::where('worksurface_id', $this->id)
                    ->where(function($query) {
                        $query->where('judgement_a1', 'NG')
                            ->orWhere('judgement_a2', 'NG');
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
        ->logOnly(['register_no','area','location']);
    }
}
