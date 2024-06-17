<?php

namespace App\Filament\Resources\EquipmentGroundDetailResource\Pages;

use App\Filament\Resources\EquipmentGroundDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEquipmentGroundDetail extends ViewRecord
{
    protected static string $resource = EquipmentGroundDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
