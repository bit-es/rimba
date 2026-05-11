<?php

declare(strict_types=1);

namespace Bites\Organization\Identity\Pages;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Profile extends BaseEditProfile
{
    public function form(Schema $schema): Schema
    {
        Auth::user()->id;
        return $schema
            ->components([

                TextInput::make('staff_number')
                    ->label('Staff')
                    ->readOnly(),

                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }

    public function getStaffNumberAttribute()
    {
        return $this->staff?->staff_number;
    }
}
