<?php

namespace App\Filament\Resources\Reviews;

use App\Enums\ReviewPlatform;
use App\Filament\Resources\Reviews\Pages\ManageReviews;
use App\Models\Review;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'avis';

    protected static ?string $pluralModelLabel = 'avis';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('name')
                    ->label('Nom')
                    ->autofocus()
                    ->required()
                    ->maxLength(255),
                DatePicker::make('reviewed_at')
                    ->label('Date')
                    ->helperText('Seuls le mois et l\'année sont affichés sur le site.')
                    ->native(false)
                    ->displayFormat('F Y')
                    ->default(now()->startOfMonth())
                    ->required(),
                Select::make('platform')
                    ->label('Plateforme')
                    ->options(ReviewPlatform::class)
                    ->required(),
                Select::make('rating')
                    ->label('Note')
                    ->options([
                        5 => '5 / 5',
                        4 => '4 / 5',
                        3 => '3 / 5',
                        2 => '2 / 5',
                        1 => '1 / 5',
                    ])
                    ->default(5)
                    ->required(),
                Textarea::make('content')
                    ->label('Contenu')
                    ->required()
                    ->rows(6)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->defaultSort('reviewed_at', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable(),
                TextColumn::make('reviewed_at')
                    ->label('Date')
                    ->formatStateUsing(fn (Review $record): string => $record->formattedDate())
                    ->sortable(),
                TextColumn::make('platform')
                    ->label('Plateforme')
                    ->badge(),
                TextColumn::make('rating')
                    ->label('Note')
                    ->formatStateUsing(fn (int $state): string => "{$state} / 5")
                    ->sortable(),
                TextColumn::make('content')
                    ->label('Contenu')
                    ->limit(60)
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Mis à jour le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('platform')
                    ->label('Plateforme')
                    ->options(ReviewPlatform::class),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageReviews::route('/'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Avis';
    }
}
