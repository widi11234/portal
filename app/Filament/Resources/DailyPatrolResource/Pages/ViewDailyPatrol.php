<?php

namespace App\Filament\Resources\DailyPatrolResource\Pages;

use Filament\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\DailyPatrolResource;
use EightyNine\Approvals\Models\ApprovableModel;
use EightyNine\Approvals\Traits\HasApprovalHeaderActions;
use Parallax\FilamentComments\Actions\CommentsAction;

class ViewDailyPatrol extends ViewRecord
{
    protected static string $resource = DailyPatrolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CommentsAction::make(),
            Actions\EditAction::make(),
        ];
    }

    // protected function getOnCompletionAction(): Action
    // {
    //     return Action::make("Done")
    //         ->color("success")
    //         // Do not use the visible method, since it is being used internally to show this action if the approval flow has been completed.
    //         // Using the hidden method add your condition to prevent the action from being performed more than once
    //         ->hidden(fn(ApprovableModel $record)=> $record->shouldBeHidden());
    // }
}
