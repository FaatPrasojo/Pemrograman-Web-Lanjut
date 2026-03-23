<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Checkbox;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([

                    // 1: Informasi Dasar Produk
                    Step::make('Product Info')
                        ->description('Isi Informasi Produk')
                        ->icon(Heroicon::OutlinedInformationCircle) // [+] Icon step 1
                        ->schema([
                            Group::make([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('sku')
                                    ->required(),
                            ])->columns(2),
                            MarkdownEditor::make('description'),
                        ]),

                    // 2: Harga dan Stok Produk
                    Step::make('Product prices and Stock')
                        ->description('Isi Harga Produk')
                        ->icon(Heroicon::OutlinedCurrencyDollar) // [+] Icon step 2
                        ->schema([
                            Group::make([
                                // Harga produk - wajib diisi, minimal > 0
                                TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->minValue(1)     // [+] Validasi harga minimal 1
                                    ->rules(['min:1'])
                                    ->validationMessages([
                                        'min' => 'Harga harus lebih dari 0.',
                                    ]),
                                TextInput::make('stock')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0),
                            ])->columns(2),
                        ]),

                    // 3: Media dan Status Produk
                    Step::make('Media and Status')
                        ->description('Isi Gambar Produk')
                        ->icon(Heroicon::OutlinedPhoto) // [+] Icon step 3
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('products'),
                            Checkbox::make('is_active'),
                            Checkbox::make('is_featured'),
                        ]),

                ])
                ->columnSpanFull()
                ->submitAction(
                    Action::make('save')
                        ->label('Save Product')
                        ->button()
                        ->color('primary')
                        ->submit('save')
                )
            ]);
    }
}