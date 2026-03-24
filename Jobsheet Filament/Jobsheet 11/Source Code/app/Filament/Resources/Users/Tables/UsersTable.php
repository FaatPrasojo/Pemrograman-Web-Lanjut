<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                // 2. Tambah kolom created_at
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // Tambahkan Actions\EditAction::make(), Actions\DeleteAction::make(), dll. di sini
            ])
            ->toolbarActions([
                // Tambahkan BulkAction atau header actions di sini
            ]);
    }
}