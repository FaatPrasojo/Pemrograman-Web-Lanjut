<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product Tabs')
                    ->tabs([
                        Tab::make('Product Details')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Product Name')
                                    ->weight('bold')
                                    ->color('primary'),

                                TextEntry::make('id')
                                    ->label('Product ID'),

                                TextEntry::make('sku')
                                    ->label('Product SKU')
                                    ->badge()
                                    ->color('success'),

                                TextEntry::make('description')
                                    ->label('Product Description'),

                                TextEntry::make('created_at')
                                    ->label('Product Creation Date')
                                    ->date('d M Y')
                                    ->color('info'),
                            ]),

                        Tab::make('Product Price and Stock')
                            ->icon('heroicon-o-banknotes')
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Product Price')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->icon('heroicon-s-currency-dollar')
                                    ->formatStateUsing(fn ($state) =>
                                        'Rp ' . number_format($state, 0, ',', '.')
                                    ),

                                TextEntry::make('stock')
                                    ->label('Product Stock')
                                    ->icon('heroicon-s-archive-box')
                                    ->badge()
                                    ->color(fn ($state) => match (true) {
                                        $state <= 0    => 'danger',
                                        $state <= 10   => 'warning',
                                        $state <= 50   => 'info',
                                        default        => 'success',
                                    })
                                    ->formatStateUsing(fn ($state) => match (true) {
                                        $state <= 0    => "Out of Stock ({$state})",
                                        $state <= 10   => "Low Stock ({$state})",
                                        $state <= 50   => "Limited Stock ({$state})",
                                        default        => "In Stock ({$state})",
                                    }),
                            ]),

                        Tab::make('Image and Status')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                ImageEntry::make('image')
                                    ->label('Product Image')
                                    ->disk('public'),

                                TextEntry::make('price')
                                    ->label('Product Price')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->icon('heroicon-s-currency-dollar')
                                    ->formatStateUsing(fn ($state) =>
                                        'Rp ' . number_format($state, 0, ',', '.')
                                    ),

                                TextEntry::make('stock')
                                    ->label('Product Stock')
                                    ->weight('bold')
                                    ->icon('heroicon-s-archive-box')
                                    ->badge()
                                    ->color(fn ($state) => match (true) {
                                        $state <= 0    => 'danger',
                                        $state <= 10   => 'warning',
                                        $state <= 50   => 'info',
                                        default        => 'success',
                                    })
                                    ->formatStateUsing(fn ($state) => match (true) {
                                        $state <= 0    => "Out of Stock ({$state})",
                                        $state <= 10   => "Low Stock ({$state})",
                                        $state <= 50   => "Limited Stock ({$state})",
                                        default        => "In Stock ({$state})",
                                    }),

                                IconEntry::make('is_active')
                                    ->label('Is Active?')
                                    ->boolean(),

                                IconEntry::make('is_featured')
                                    ->label('Is Featured?')
                                    ->boolean(),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->vertical(),
            ]);
    }
}