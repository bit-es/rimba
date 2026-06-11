<?php

namespace App\Filament\Resources\RoleAssignments;

use App\Filament\Resources\RoleAssignments\Pages\CreateRoleAssignment;
use App\Filament\Resources\RoleAssignments\Pages\EditRoleAssignment;
use App\Filament\Resources\RoleAssignments\Pages\ListRoleAssignments;
use App\Filament\Resources\RoleAssignments\Pages\ViewRoleAssignment;
use App\Filament\Resources\RoleAssignments\Schemas\RoleAssignmentForm;
use App\Filament\Resources\RoleAssignments\Schemas\RoleAssignmentInfolist;
use App\Filament\Resources\RoleAssignments\Tables\RoleAssignmentsTable;
use App\Models\AuthZ\RoleAssignment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RoleAssignmentResource extends Resource
{
    protected static ?string $model = RoleAssignment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return RoleAssignmentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RoleAssignmentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RoleAssignmentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRoleAssignments::route('/'),
            'create' => CreateRoleAssignment::route('/create'),
            'view' => ViewRoleAssignment::route('/{record}'),
            'edit' => EditRoleAssignment::route('/{record}/edit'),
        ];
    }
}
