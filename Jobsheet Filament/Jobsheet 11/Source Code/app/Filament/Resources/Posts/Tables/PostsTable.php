<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // 1. Search aktif pada 3 kolom (title, slug, category.name)

                TextColumn::make('title')
                    ->label('Title')
                    ->sortable()
                    ->searchable(),      

                TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable()
                    ->searchable(),      

                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),     

                ColorColumn::make('color')
                    ->label('Color'),

                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public'),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'asc')

            ->filters([
                // 2. Filter tanggal Created At
                Filter::make('created_at')
                    ->label('Creation Date')
                    ->schema([
                        DatePicker::make('created_at')
                            ->label('Select Date:'),
                    ])
                    ->query(function ($query, $data) {
                        return $query->when(
                            $data['created_at'],
                            fn ($query, $date) => $query->whereDate('created_at', $date)
                        );
                    }),

                // 3. Filter kategori menggunakan SelectFilter
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->preload(),
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