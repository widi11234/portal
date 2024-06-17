<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Glove extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable =['sap_code','description','delivery'];

    public function gloveDetails()
    {
        return $this->hasMany(GloveDetail::class);
    }

    public function getJudgementCountsAttribute()
    {
        $okCount = GloveDetail::where('glove_id', $this->id)->where('judgement', 'OK')->count();
        $ngCount = GloveDetail::where('glove_id', $this->id)->where('judgement', 'NG')->count();

        return [
            'ok' => $okCount,
            'ng' => $ngCount
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['sap_code','description','delivery']);
    }
}
