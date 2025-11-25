<?php

namespace App\Filament\Resources\Categories;

use App\Filament\Enums\NavigationGroups;
use App\Filament\Resources\Categories\Pages\ManageCategories;
use App\Models\Category;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use UnitEnum;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static string | UnitEnum | null $navigationGroup = NavigationGroups::BLOG;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                TextInput::make('name')
                    ->label('Nom')
                    ->autofocus()
                    ->live(true)
                    ->afterStateUpdated(
                        function (Get $get, Set $set, ?string $operation, ?string $old, ?string $state) {
                            if ($operation == 'create') {
                                $set('slug', Str::slug($state));
                            }
                        }
                    )
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->label('Slug')
                    ->prefix('/articles/')
                    ->required()
                    ->maxLength(255),
                Toggle::make('is_active')
                    ->label('Activer ?')
                    ->default(0)
                    ->onColor('success')
                    ->offColor('danger')
                    ->inline(false)
                    ->required(),
                Textarea::make('catch_phrase')
                    ->label('Phrase d\'accroche')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('meta_title')
                    ->label('Meta-titre')
                    ->required(),
                Textarea::make('meta_description')
                    ->label('Meta-description')
                    ->required()
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Nom'),
                IconColumn::make('is_active')
                    ->label('Active')
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
                    Action::make('Voir en ligne')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Category $category): string => route('category', ['slug' => $category->slug]))
                    ->openUrlInNewTab(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageCategories::route('/'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Catégories';
    }
}
