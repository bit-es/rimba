<?php

declare(strict_types=1);

namespace Bites\Support\Shared\Http\UI;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Actions;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;

class VersionsRelationManager extends RelationManager
{
    protected static string $relationship = 'versions';

    protected static ?string $title = 'Versions';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Forms\Components\Radio::make('level')
                    ->options([
                        'major' => 'Major',
                        'minor' => 'Minor',
                        'patch' => 'Patch',
                    ])
                    ->default('patch')
                    ->required(),

                Forms\Components\FileUpload::make('content_path')
                    ->label('Upload File')
                    ->directory('documents')
                    ->preserveFilenames(),

                Forms\Components\TextInput::make('content_url')
                    ->label('External URL'),

                Forms\Components\Select::make('content_type')
                    ->options([
                        'file' => 'File',
                        'link' => 'External Link',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('notes'),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('semver')
                    ->label('Version')
                    ->badge()
                    ->color(fn($record) => match (true) {
                        $record->minor === 0 && $record->patch === 0 => 'danger',
                        $record->patch === 0 => 'warning',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('notes')
                    ->limit(50),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'gray' => 'draft',
                        'warning' => 'approved',
                        'success' => 'published',
                        'danger' => 'rejected',
                    ]),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User'),

                Tables\Columns\TextColumn::make('created_at')
                    ->since(),
            ])
            ->headerActions([
                Actions\CreateAction::make()
                    ->using(function (array $data) {
                        return $this->getOwnerRecord()->createVersion(
                            level: $data['level'],
                            notes: $data['notes'] ?? null,
                            contentPath: $data['content_path'] ?? null,
                            contentUrl: $data['content_url'] ?? null,
                            contentType: $data['content_type'] ?? null,
                        );
                    }),
            ])
            ->toolbarActions([
                Actions\Action::make('restore')
                    ->label('Restore')
                    ->action(
                        fn($record) =>
                        $this->getOwnerRecord()->restoreVersion($record)
                    )
                    ->requiresConfirmation(),
            ]);
    }
}
