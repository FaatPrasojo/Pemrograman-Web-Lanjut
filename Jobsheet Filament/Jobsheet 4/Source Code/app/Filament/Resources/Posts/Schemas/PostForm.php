<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Category;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. Text Input — Title & Slug
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    // Tugas #1a: Validasi title minimal 5 karakter
                    ->minLength(5)
                    ->validationMessages([
                        'min' => 'Title minimal harus 5 karakter.',
                    ]),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    // Tugas #1b: Validasi slug unik
                    ->unique(
                        table: 'posts',
                        column: 'slug',
                        ignorable: fn ($record) => $record // abaikan record saat edit
                    )
                    ->validationMessages([
                        'unique' => 'Slug ini sudah digunakan, gunakan slug lain.',
                    ]),

                // 2. Select — Relasi Category
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),

                // 3. Color Picker
                ColorPicker::make('color'),

                // 4. Rich Editor (Body/Content)
                // Alternatif: MarkdownEditor::make('content')
                RichEditor::make('content'),

                // 5. File Upload (Image)
                FileUpload::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->directory('posts'),

                // 6. Tags Input
                TagsInput::make('tags'),

                // 7. Checkbox — Published
                Checkbox::make('published'),

                // 8. Date Picker — Published At
                DateTimePicker::make('published_at'),
            ]);
    }
}