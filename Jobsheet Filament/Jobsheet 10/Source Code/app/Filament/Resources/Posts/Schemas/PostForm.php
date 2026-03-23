<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Category;
use App\Models\Post;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
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
                // Section 1 - Post Details
                Section::make("Post Details")
                    ->description("Fill in the details of the post")
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Group::make([

                            // 1a: Title minimal 5 karakter + custom message
                            TextInput::make('title')
                                ->required()
                                ->minLength(5)
                                ->maxLength(255)
                                ->validationMessages([
                                    'required' => 'Judul post wajib diisi.',
                                    'min'      => 'Judul post minimal harus :min karakter.',
                                ]),

                            // 1b: Slug unik & minimal 3 karakter + custom message
                            TextInput::make('slug')
                                ->required()
                                ->minLength(3)
                                ->unique(
                                    table: Post::class,
                                    column: 'slug',
                                    ignoreRecord: true  // agar tidak conflict saat Edit
                                )
                                ->validationMessages([
                                    'required' => 'Slug wajib diisi.',
                                    'unique'   => 'Slug sudah digunakan, silakan pilih slug lain.',
                                    'min'      => 'Slug minimal harus :min karakter.',
                                ]),

                            // 1c: Category wajib dipilih
                            Select::make('category_id')
                                ->label('Category')
                                ->relationship('category', 'name')
                                ->required()
                                ->preload()
                                ->searchable(),

                            ColorPicker::make('color'),

                        ])->columns(2),

                        MarkdownEditor::make('content')
                            ->columnSpanFull(),

                    ])->columnSpan(2),

                Group::make([
                    // Section 2 - Image Upload
                    Section::make("Image Upload")
                        ->icon('heroicon-o-photo')
                        ->schema([

                            // 1d: Image wajib diupload
                            FileUpload::make('image')
                                ->required()
                                ->image()         // hanya terima file gambar
                                ->maxSize(2048)   // maksimal 2MB
                                ->disk('public')
                                ->directory('posts'),

                        ]),

                    // Section 3 - Meta Information
                    Section::make("Meta Information")
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            TagsInput::make('tags'),
                            Checkbox::make('published'),
                            DateTimePicker::make('published_at'),
                        ]),

                ])->columnSpan(1),

            ])->columns(3);
    }
}