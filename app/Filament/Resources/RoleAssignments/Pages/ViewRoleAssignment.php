<?php

namespace App\Filament\Resources\RoleAssignments\Pages;

use App\Filament\Resources\RoleAssignments\RoleAssignmentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRoleAssignment extends ViewRecord
{
    protected static string $resource = RoleAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
