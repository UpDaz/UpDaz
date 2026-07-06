<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use App\Models\Article;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Icons\Heroicon;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('viewOnline')
                ->label('Voir en ligne')
                ->icon(Heroicon::Eye)
                ->url(fn (Article $record): string => $record->frontendUrl())
                ->openUrlInNewTab(),
            DeleteAction::make(),
        ];
    }
}
