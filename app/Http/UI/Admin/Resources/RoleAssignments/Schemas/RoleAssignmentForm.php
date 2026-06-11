<?php

namespace App\Http\UI\Admin\Resources\RoleAssignments\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\{
    Select,
    DatePicker,
    Textarea
};
use App\Models\Org\OrgTeam;
use Spatie\Permission\Models\Role;

class RoleAssignmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Assignment')
                    ->schema([
                        Select::make('staff_id')
                            ->label('Staff')
                            ->relationship('staff', 'name')
                            ->searchable()
                            ->required(),
                        Select::make('role_id')
                            ->label('Role')
                            ->options(Role::query()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                    ])->columns(2),
                Section::make('Context')
                    ->description('Assign role within a specific context')
                    ->schema([
                        Select::make('org_unit_id')
                            ->label('Org Unit')
                            ->relationship('orgUnit', 'name')
                            ->searchable(),
                        Select::make('org_team_id')
                            ->label('Org Team')
                            ->relationship('orgTeam', 'name')
                            ->searchable()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $team = OrgTeam::find($state);
                                    $set('org_unit_id', $team?->org_unit_id);
                                }
                            }),
                    ])->columns(2),
                Section::make('Validity')
                    ->schema([
                        DatePicker::make('start_date'),
                        DatePicker::make('end_date'),
                    ])->columns(2),
                Section::make('Extra')
                    ->schema([
                        Textarea::make('attributes')
                            ->json()
                            ->rows(3),
                    ]),
            ]);
    }
}
