<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Spatie\Activitylog\Traits\LogsActivity;
use EightyNine\Approvals\Models\ApprovableModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;

class DailyPatrol extends ApprovableModel
{
    use HasFactory, LogsActivity, HasFilamentComments;

    protected $fillable = [
        'description_problem',
        'area',
        'location',
        'status',
        'photo_before',
        'photo_after',
        'corrective_action',
        'date_corrective',
        'status'
    ];

    public function getPhotoBeforeUrlAttribute()
    {
        return Storage::disk('public')->url($this->photo_before);
    }

    public function getPhotoAfterUrlAttribute()
    {
        return Storage::disk('public')->url($this->photo_after);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['description_problem', 'area', 'location', 'photo_before', 'photo_after', 'corrective_action', 'date_corrective', 'status']);
    }

    public function toDatabase(DailyPatrol $notifiable): array
    {
        return Notification::make()
            ->title('Saved successfully')
            ->getDatabaseMessage();
    }
}
