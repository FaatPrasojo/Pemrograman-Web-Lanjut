<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->sortable()
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('slug')
                    ->sortable()
                    ->label('Slug')
                    ->searchable(),
                
                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable(),

                ColorColumn::make('color')
                    ->label('Color'),

                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public'),

                TextColumn::make('created_at') 
                    ->label('Created At') 
                    ->dateTime() 
                    ->sortable(),
            ])->defaultSort('Created_at', 'asc')
        
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}