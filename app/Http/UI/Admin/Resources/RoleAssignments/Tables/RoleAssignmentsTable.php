<?php

namespace App\Http\UI\Admin\Resources\RoleAssignments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables;

class RoleAssignmentsTable
{
    public static function configure(Tables\Table $table): Tables\Table
    {
        return $table

            ->columns([
                Tables\Columns\TextColumn::make('staff.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role.name')
                    ->badge(),
                Tables\Columns\TextColumn::make('orgUnit.name')
                    ->label('Unit')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('orgTeam.name')
                    ->label('Team')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->relationship('role', 'name'),
                Tables\Filters\SelectFilter::make('org_unit_id')
                    ->relationship('orgUnit', 'name'),
                Tables\Filters\SelectFilter::make('org_team_id')
                    ->relationship('orgTeam', 'name'),
            ]);
    }
}
