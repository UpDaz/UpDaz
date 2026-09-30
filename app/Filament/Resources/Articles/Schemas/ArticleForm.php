<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Article;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('title')
                    ->columnSpan(1)
                    ->autofocus()
                    ->live(true)
                    ->afterStateUpdated(
                        function (Get $get, Set $set, ?string $operation, ?string $old, ?string $state) {
                            if ($operation === 'create') {
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
                    ->label('Catégorie principale')
                    ->helperText("Utilisée dans l'URL de l'article.")
                    ->columnSpan(1)
                    ->relationship(name: 'category', titleAttribute: 'name'),
                Select::make('categories')
                    ->label('Catégories')
                    ->helperText('La catégorie principale y est ajoutée automatiquement.')
                    ->columnSpan(1)
                    ->multiple()
                    ->preload()
                    ->relationship(name: 'categories', titleAttribute: 'name')
                    ->saveRelationshipsUsing(function (Article $record, array $state): void {
                        $record->categories()->sync(
                            collect($state)->push($record->category_id)->filter()->unique()->all()
                        );
                    }),
                DatePicker::make('published_at')
                    ->label('Date de publication')
                    ->columnSpan(1)
                    ->live()
                    ->required(),
                Toggle::make('is_published')
                    ->columnSpan(1)
                    ->label('Publier ?')
                    ->default(false)
                    ->onColor('success')
                    ->offColor('danger')
                    ->live()
                    ->inline(false),
                ObsoleteUrlTargetSelect::make()
                    ->columnSpanFull()
                    ->visible(fn (Get $get, ?Article $record): bool => self::isBeingTakenOffline($get, $record))
                    ->required(fn (Get $get, ?Article $record): bool => self::isBeingTakenOffline($get, $record)),
                MarkdownEditor::make('content')
                    ->columnSpanFull()
                    ->fileAttachmentsAcceptedFileTypes(['image/png', 'image/jpeg']),
            ]);
    }

    private static function isBeingTakenOffline(Get $get, ?Article $record): bool
    {
        if (! $record?->can_be_read) {
            return false;
        }

        if (! $get('is_published')) {
            return true;
        }

        return Carbon::parse($get('published_at'))->isFuture();
    }
}
