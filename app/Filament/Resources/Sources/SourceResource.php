<?php

namespace App\Filament\Resources\Sources;

use App\Enums\SourceType;
use App\Filament\Enums\NavigationGroups;
use App\Filament\Resources\Sources\Pages\ManageSources;
use App\Models\Source;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use UnitEnum;

class SourceResource extends Resource
{
    protected static ?string $model = Source::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRss;

    protected static ?string $recordTitleAttribute = 'name';

    protected static string|UnitEnum|null $navigationGroup = NavigationGroups::Blog;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                TextInput::make('name')
                    ->label('Nom')
                    ->autofocus()
                    ->required()
                    ->maxLength(255),
                TextInput::make('url')
                    ->label('URL')
                    ->url()
                    ->required()
                    ->maxLength(255),
                Select::make('type')
                    ->label('Type')
                    ->options(SourceType::class)
                    ->required(),
                Toggle::make('active')
                    ->label('Active ?')
                    ->default(true)
                    ->onColor('success')
                    ->offColor('danger')
                    ->inline(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable(),
                TextColumn::make('url')
                    ->label('URL')
                    ->searchable()
                    ->limit(40),
                TextColumn::make('type')
                    ->label('Type')
                    ->badge(),
                IconColumn::make('active')
                    ->label('Active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Créée le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Mise à jour le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Type')
                    ->options(SourceType::class),
                TernaryFilter::make('active')
                    ->label('Active'),
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
            'index' => ManageSources::route('/'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Sources';
    }
}
