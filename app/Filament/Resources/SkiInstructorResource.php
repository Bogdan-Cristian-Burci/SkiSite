<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkiInstructorResource\Pages;
use App\Filament\Resources\SkiInstructorResource\RelationManagers;
use App\Models\SkiInstructor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SkiInstructorResource extends Resource
{
    protected static ?string $model = SkiInstructor::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationGroup = 'Team Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Instructor Information')
                    ->schema([
                        Forms\Components\TextInput::make('instructor_name')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255)
                            ->visible(fn ($context) => $context === 'create'),
                        Forms\Components\TextInput::make('instructor_email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->visible(fn ($context) => $context === 'create'),
                        Forms\Components\TextInput::make('instructor_phone')
                            ->label('Phone Number')
                            ->tel()
                            ->required()
                            ->maxLength(20)
                            ->visible(fn ($context) => $context === 'create'),
                        Forms\Components\Tabs::make('Position')
                            ->tabs([
                                Forms\Components\Tabs\Tab::make('English')
                                    ->schema([
                                        Forms\Components\TextInput::make('position.en')
                                            ->label('Position (English)')
                                            ->required()
                                            ->maxLength(255),
                                    ]),
                                Forms\Components\Tabs\Tab::make('Romanian')
                                    ->schema([
                                        Forms\Components\TextInput::make('position.ro')
                                            ->label('Position (Romanian)')
                                            ->required()
                                            ->maxLength(255),
                                    ]),
                            ])
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image_path')
                            ->image()
                            ->required(),
                        Forms\Components\Tabs::make('Bio')
                            ->tabs([
                                Forms\Components\Tabs\Tab::make('English')
                                    ->schema([
                                        Forms\Components\Textarea::make('bio.en')
                                            ->label('Bio (English)')
                                            ->required()
                                            ->rows(4),
                                    ]),
                                Forms\Components\Tabs\Tab::make('Romanian')
                                    ->schema([
                                        Forms\Components\Textarea::make('bio.ro')
                                            ->label('Bio (Romanian)')
                                            ->required()
                                            ->rows(4),
                                    ]),
                            ])
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('User Account')
                    ->schema([
                        Forms\Components\TextInput::make('user.name')
                            ->label('Instructor Name')
                            ->disabled()
                            ->visible(fn ($context) => $context === 'edit'),
                        Forms\Components\TextInput::make('user.email')
                            ->label('Email')
                            ->disabled()
                            ->visible(fn ($context) => $context === 'edit'),
                        Forms\Components\TextInput::make('user.phone')
                            ->label('Phone Number')
                            ->tel()
                            ->maxLength(20)
                            ->visible(fn ($context) => $context === 'edit'),
                    ])
                    ->visible(fn ($context) => $context === 'edit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_path'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Instructor Name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
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
            'index' => Pages\ListSkiInstructors::route('/'),
            'create' => Pages\CreateSkiInstructor::route('/create'),
            'edit' => Pages\EditSkiInstructor::route('/{record}/edit'),
        ];
    }
}
