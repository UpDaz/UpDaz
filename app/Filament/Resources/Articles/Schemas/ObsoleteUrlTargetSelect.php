<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Article;
use App\Models\Redirect;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Select;

/**
 * Asked whenever a readable article stops being served (unpublished,
 * scheduled later or deleted), so its URL never falls back to a 302.
 */
class ObsoleteUrlTargetSelect
{
    public const GONE = 'gone';

    public const SERVICE_PAGES = [
        'home' => 'Accueil',
        'articles' => 'Liste des articles',
        'laravel' => 'Application web Laravel',
        'webflow' => 'Site Webflow',
        'ecommerce' => 'E-commerce sur mesure',
    ];

    public static function make(): Select
    {
        return Select::make('obsolete_url_target')
            ->label("Que faire de l'URL actuelle de l'article ?")
            ->helperText('Rediriger (301) vers un contenu équivalent, ou déclarer la page supprimée (410).')
            ->options(fn (?Article $record): array => self::options($record))
            ->searchable()
            ->dehydrated(false);
    }

    public static function configureDeleteAction(DeleteAction $action): DeleteAction
    {
        return $action
            ->schema(fn (Article $record): array => $record->can_be_read
                ? [self::make()->required()->dehydrated()]
                : [])
            ->before(function (array $data, Article $record): void {
                $obsoletePath = $record->can_be_read ? $record->publicPath() : null;

                if ($obsoletePath === null) {
                    return;
                }

                self::apply($obsoletePath, $data['obsolete_url_target']);
            });
    }

    public static function apply(string $obsoletePath, string $target): void
    {
        Redirect::register($obsoletePath, $target === self::GONE ? null : $target);
    }

    /** @return array<string, string|array<string, string>> */
    private static function options(?Article $record): array
    {
        $servicePages = collect(self::SERVICE_PAGES)
            ->mapWithKeys(fn (string $label, string $routeName): array => [route($routeName, [], false) => $label])
            ->all();

        $articles = Article::query()
            ->readable()
            ->whereNotNull('category_id')
            ->when($record, fn ($query) => $query->whereKeyNot($record->id))
            ->with('category')
            ->orderBy('title')
            ->get()
            ->mapWithKeys(fn (Article $article): array => [
                route('article', ['categorySlug' => $article->category->slug, 'slug' => $article->slug], false) => $article->title,
            ])
            ->all();

        return [
            self::GONE => 'Page supprimée (410)',
            'Redirection vers une page' => $servicePages,
            'Redirection vers un article' => $articles,
        ];
    }
}
