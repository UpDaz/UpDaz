<?php

namespace App\Filament\Resources\Articles\Tables;

use App\Models\Article;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('published_at', 'desc')
            ->columns([
                TextColumn::make('title')
                    ->label('Titre'),
                TextColumn::make('published_at')
                    ->label('Date de publication')
                    ->dateTime('d/m/Y')
                    ->sortable(),
                TextColumn::make('category')
                    ->label('Catégorie')
                    ->formatStateUsing(fn (Article $article): string => $article->category->name),
                IconColumn::make('is_published')
                    ->label('Publié')
                    ->icon(fn (int $state): Heroicon => match ($state) {
                        0 => Heroicon::OutlinedXCircle,
                        1 => Heroicon::OutlinedCheckCircle,
                    })
                    ->color(fn (int $state): string => match ($state) {
                        0 => 'danger',
                        1 => 'success',
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    Action::make('Voir en ligne')
                        ->icon('heroicon-o-eye')
                        ->url(fn (Article $article): string => route('article', [
                                'categorySlug' => $article->category->slug,
                                'slug' => $article->slug
                            ]))
                        ->openUrlInNewTab(),
                ])
            ]);
    }
}
