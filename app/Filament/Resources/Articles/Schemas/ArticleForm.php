<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                TextInput::make('title')
                    ->columnSpan(2)
                    ->autofocus()
                    ->live(true)
                    ->afterStateUpdated(
                        function (Get $get, Set $set, ?string $operation, ?string $old, ?string $state) {
                            if ($operation == 'create') {
                                $set('slug', Str::slug($state));
                            }
                        }
                    )
                    ->required(),
                TextInput::make('slug')
                    ->columnSpanFull()
                    ->columnSpan(1)
                    ->required(),
                TextInput::make('catch_phrase')
                    ->columnSpanFull()
                    ->required(),
                Select::make('category_id')
                    ->columnSpan(1)
                    ->relationship(name: 'category', titleAttribute: 'name'),
                DatePicker::make('published_at')
                    ->label('Date de publication')
                    ->columnSpan(1)
                    ->required(),
                Toggle::make('is_published')
                    ->columnSpan(1)
                    ->label('Publier ?')
                    ->default(false)
                    ->onColor('success')
                    ->offColor('danger')
                    ->inline(false),
                RichEditor::make('content')
                    ->columnSpanFull()
                    ->fileAttachmentsAcceptedFileTypes(['image/png', 'image/jpeg']),
            ]);
    }
}
