<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;


class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('name')
                ->required(), 
                
                TextInput::make('slug')
                ->required()
                // 2. Menambahkan validasi unik ke tabel categories
                ->unique(table: 'categories', column: 'slug', ignoreRecord: true),
            ]);
    }
}
