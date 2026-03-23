<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Category;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
//use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //section 1 - post detail
                Section::make("Post Details")
                ->description("Fill in the details of the post")
                ->icon('heroicon-o-document-text')
                ->schema([
                    Group::make([ 
                        TextInput::make('title'), 
                        TextInput::make('slug'), 
                        Select::make('category_id')
                            ->relationship("category", "name")
                            ->preload()
                            ->searchable(),
                        ColorPicker::make("color"),
                    ])->columns(2),
                    MarkdownEditor::make("content")
                        ->columnSpanFull(), // Ditambahkan agar editor memenuhi lebar section
                ])->columnSpan(2),
                // RichEditor::make("content"),
                
                Group::make([
                    // section 2 - image
                    Section::make("Image Upload")
                    ->icon('heroicon-o-photo') // Menambahkan icon sesuai instruksi
                    ->schema([
                        FileUpload::make("image")
                        ->disk("public")
                        ->directory("posts")
                    ]),

                    // section 3 - meta
                    Section::make("Meta Information")
                    ->icon('heroicon-o-information-circle') // Menambahkan icon sesuai instruksi
                    ->schema([
                        TagsInput::make("tags"),
                        Checkbox::make("published"),
                        DateTimePicker::make("published_at"),
                    ]) // Menghapus columnSpan(1) dari sini
                ])->columnSpan(1), // Memindahkan columnSpan(1) ke Group agar rapi di kanan
            ])->columns(3);
    }
}