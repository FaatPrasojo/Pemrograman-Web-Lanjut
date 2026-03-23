<?php

namespace App\Filament\Resources\Products\Schemas;


use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product Info')
                ->description('')
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
                        ->color('warning'),             // 1. Warna badge SKU diubah menjadi warning (kuning)
                    TextEntry::make('description')
                        ->label('Product Description'),
                    TextEntry::make('created_at')
                        ->label('Product Creation Date')
                        ->date('d M Y')
                        ->color('info'),
                ])      
                ->columnSpanFull(),

                Section::make('Product Price and Stock')
                    ->description('')
                    ->schema([
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-s-currency-dollar')
                            ->formatStateUsing(fn ($state) =>    // 3. Format harga menjadi Rp
                                'Rp ' . number_format($state, 0, ',', '.')
                            ),
                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->icon('heroicon-s-archive-box'),     // 2. Tambah icon pada Stock
                    ])
                    ->columnSpanFull(),

                Section::make('Image and Status')
                    ->description('')
                    ->schema([
                        ImageEntry::make('image')
                            ->label('Product Image')    
                            ->disk('public'),
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-s-currency-dollar')
                            ->formatStateUsing(fn ($state) =>    // 3. Format harga menjadi Rp (konsisten)
                                'Rp ' . number_format($state, 0, ',', '.')
                            ),
                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-s-archive-box'),    // 2. Tambah icon pada Stock (konsisten)
                        IconEntry::make('is_active')
                            ->label('Is Active?')
                            ->boolean(),
                        IconEntry::make('is_featured')
                            ->label('Is Featured?')
                            ->boolean(),
                    ])
                ->columnSpanFull(),
            ]);
    }
}