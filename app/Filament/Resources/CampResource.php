<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CampResource\Pages;
use App\Filament\Resources\CampResource\RelationManagers;
use App\Models\Camp;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CampResource extends Resource
{
    protected static ?string $model = Camp::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationGroup = 'Programs & Services';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title.en')
                    ->label('Title (English)')
                    ->required(),
                Forms\Components\TextInput::make('title.ro')
                    ->label('Title (Romanian)')
                    ->required(),
                Forms\Components\RichEditor::make('article_content.en')
                    ->label('Article Content (English)')
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('article_content.ro')
                    ->label('Article Content (Romanian)')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->required(),
                Forms\Components\TextInput::make('age_condition.en')
                    ->label('Age Condition (English)')
                    ->required(),
                Forms\Components\TextInput::make('age_condition.ro')
                    ->label('Age Condition (Romanian)')
                    ->required(),
                Forms\Components\TextInput::make('location.en')
                    ->label('Location (English)')
                    ->required(),
                Forms\Components\TextInput::make('location.ro')
                    ->label('Location (Romanian)')
                    ->required(),
                Forms\Components\TextInput::make('latitude')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('longitude')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('price_info.en')
                    ->label('Price Info (English)')
                    ->required(),
                Forms\Components\TextInput::make('price_info.ro')
                    ->label('Price Info (Romanian)')
                    ->required(),
                Forms\Components\TextInput::make('transport_info.en')
                    ->label('Transport Info (English)')
                    ->required(),
                Forms\Components\TextInput::make('transport_info.ro')
                    ->label('Transport Info (Romanian)')
                    ->required(),
                Forms\Components\TextInput::make('meal_info.en')
                    ->label('Meal Info (English)')
                    ->required(),
                Forms\Components\TextInput::make('meal_info.ro')
                    ->label('Meal Info (Romanian)')
                    ->required(),
                Forms\Components\TextInput::make('accommodation_info.en')
                    ->label('Accommodation Info (English)')
                    ->required(),
                Forms\Components\TextInput::make('accommodation_info.ro')
                    ->label('Accommodation Info (Romanian)')
                    ->required(),
                Forms\Components\FileUpload::make('image_path')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('capacity')
                    ->label('Capacity')
                    ->required()
                    ->numeric()
                    ->integer(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image_path'),
                Tables\Columns\TextColumn::make('latitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
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
            'index' => Pages\ListCamps::route('/'),
            'create' => Pages\CreateCamp::route('/create'),
            'edit' => Pages\EditCamp::route('/{record}/edit'),
        ];
    }
}
