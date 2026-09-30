<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use App\Filament\Resources\Articles\Schemas\ObsoleteUrlTargetSelect;
use App\Models\Article;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Icons\Heroicon;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    /**
     * The URL the article was served at before this save, if it was readable.
     */
    private ?string $pathBeforeSave = null;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('viewOnline')
                ->label('Voir en ligne')
                ->icon(Heroicon::Eye)
                ->url(fn (Article $record): string => $record->frontendUrl())
                ->openUrlInNewTab(),
            ObsoleteUrlTargetSelect::configureDeleteAction(DeleteAction::make()),
        ];
    }

    protected function beforeSave(): void
    {
        $this->pathBeforeSave = $this->record->can_be_read
            ? $this->record->publicPath()
            : null;
    }

    protected function afterSave(): void
    {
        $target = $this->data['obsolete_url_target'] ?? null;

        if ($this->pathBeforeSave === null) {
            return;
        }

        if ($this->record->can_be_read) {
            return;
        }

        if (! $target) {
            return;
        }

        ObsoleteUrlTargetSelect::apply($this->pathBeforeSave, $target);
    }
}
