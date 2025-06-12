<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkiProgramResource\Pages;
use App\Filament\Resources\SkiProgramResource\RelationManagers;
use App\Models\SkiProgram;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SkiProgramResource extends Resource
{
    use Translatable;

    protected static ?string $model = SkiProgram::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Programs & Services';

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
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->image()
                            ->required(),
                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->prefix('$'),
                    ]),
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Textarea::make('description.en')
                            ->label('Description (English)')
                            ->required()
                            ->maxLength(5000)
                            ->live(onBlur: true)
                            ->hint(fn ($state) => 'Characters: ' . mb_strlen($state ?? '') . '/5000'),
                        Forms\Components\Textarea::make('description.ro')
                            ->label('Description (Romanian)')
                            ->required()
                            ->maxLength(5000)
                            ->live(onBlur: true)
                            ->hint(fn ($state) => 'Characters: ' . mb_strlen($state ?? '') . '/5000'),
                    ]),
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('price_label.en')
                            ->label('Price Label (English)'),
                        Forms\Components\TextInput::make('price_label.ro')
                            ->label('Price Label (Romanian)'),
                    ]),
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Repeater::make('included_services.en')
                            ->label('Included Services (English)')
                            ->simple(
                                Forms\Components\TextInput::make('service')
                                    ->required()
                            ),
                        Forms\Components\Repeater::make('included_services.ro')
                            ->label('Included Services (Romanian)')
                            ->simple(
                                Forms\Components\TextInput::make('service')
                                    ->required()
                            ),
                    ]),
                Forms\Components\RichEditor::make('details.en')
                    ->label('Details (English)')
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('details.ro')
                    ->label('Details (Romanian)')
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('how_we_work.en')
                    ->label('How We Work (English)')
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('how_we_work.ro')
                    ->label('How We Work (Romanian)')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('gallery')
                    ->multiple()
                    ->image(),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_path'),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price_label')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
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
            'index' => Pages\ListSkiPrograms::route('/'),
            'create' => Pages\CreateSkiProgram::route('/create'),
            'edit' => Pages\EditSkiProgram::route('/{record}/edit'),
        ];
    }
}
