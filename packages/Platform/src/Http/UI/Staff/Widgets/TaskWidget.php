<?php

declare(strict_types=1);

namespace Bites\Platform\Http\UI\Staff\Widgets;

use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Bites\Platform\Entities\Task;

class TaskWidget extends TableWidget
{
    protected int|string|array $columnSpan = 3;

    protected function getHeading(): ?string
    {
        return __('Tasks');
    }

    protected function getDescription(): ?string
    {
        return __('Your action needed');
    }

    public function table(Table $table): Table
    {
   dd(Auth::user()->staff);
    return $table
        ->query(
            Task::query()
                ->where('assigned_to', Auth::id()) // adjust column name
        )
        ->columns([
            // define columns here
        ]);

    }
}
