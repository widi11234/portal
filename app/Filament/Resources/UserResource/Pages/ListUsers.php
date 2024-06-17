<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ListRecords;
use Tapp\FilamentInvite\Actions\InviteAction;
use App\Filament\Resources\UserResource\Widgets\UserStatsOverview;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // InviteAction::make(),
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            //UserStatsOverview::class,
        ];
    }
}
