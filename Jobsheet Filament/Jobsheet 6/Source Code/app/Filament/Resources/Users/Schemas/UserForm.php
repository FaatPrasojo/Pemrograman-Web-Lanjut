<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Password;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Nama')
                ->required()
                ->maxLength(255),

            // 1. Validasi email unik
            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->maxLength(255)
                ->unique(
                    table: 'users',
                    column: 'email',
                    ignorable: fn ($record) => $record // abaikan record saat edit
                )
                ->validationMessages([
                    'unique' => 'Email ini sudah digunakan oleh pengguna lain.',
                ]),

            // 1. Validasi password minimal 6 karakter
            TextInput::make('password')
                ->label('Password')
                ->password()
                ->required(fn (string $operation): bool => $operation === 'create')
                ->minLength(6)
                ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                ->dehydrated(fn ($state) => filled($state))
                ->validationMessages([
                    'min' => 'Password minimal harus 6 karakter.',
                ]),
        ]);
    }
}