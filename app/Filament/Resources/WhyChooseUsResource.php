<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WhyChooseUsResource\Pages;
use App\Filament\Resources\WhyChooseUsResource\RelationManagers;
use App\Models\WhyChooseUs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WhyChooseUsResource extends Resource
{
    protected static ?string $model = WhyChooseUs::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $navigationLabel = 'Why Choose Us';
    protected static ?string $navigationGroup = 'Home Page Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title.en')
                    ->label('Title (English)')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title.ro')
                    ->label('Title (Romanian)')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('subtitle.en')
                    ->label('Subtitle (English)')
                    ->required()
                    ->maxLength(500),
                Forms\Components\Textarea::make('subtitle.ro')
                    ->label('Subtitle (Romanian)')
                    ->required()
                    ->maxLength(500),
                Forms\Components\TextInput::make('icon')
                    ->label('Icon Class')
                    ->required()
                    ->placeholder('e.g., linearicons-landscape, linearicons-users2')
                    ->helperText('Use Linearicons class names like linearicons-landscape, linearicons-users2, etc.')
                    ->maxLength(255),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->numeric()
                    ->default(0)
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->getStateUsing(function ($record) {
                        return $record->getTranslation('title', app()->getLocale());
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->getStateUsing(function ($record) {
                        return $record->getTranslation('subtitle', app()->getLocale());
                    })
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('icon')
                    ->label('Icon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Sort Order')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWhyChooseUs::route('/'),
            'create' => Pages\CreateWhyChooseUs::route('/create'),
            'edit' => Pages\EditWhyChooseUs::route('/{record}/edit'),
        ];
    }
}
