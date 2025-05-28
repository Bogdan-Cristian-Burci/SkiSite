<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeaderImageResource\Pages;
use App\Filament\Resources\HeaderImageResource\RelationManagers;
use App\Models\HeaderImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HeaderImageResource extends Resource
{
    protected static ?string $model = HeaderImage::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    
    protected static ?string $navigationGroup = 'Website';
    
    protected static ?string $navigationLabel = 'Header Images';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('route_name')
                    ->label('Route/Page')
                    ->options([
                        'home' => 'Home Page',
                        'programs' => 'Programs',
                        'programs.show' => 'Individual Program',
                        'blog' => 'Blog',
                        'blog.show' => 'Individual Blog Post',
                        'team' => 'Team',
                        'team.show' => 'Individual Instructor',
                        'testimonials' => 'Testimonials',
                        'gallery' => 'Gallery',
                        'webcams' => 'Webcams',
                        'about' => 'About',
                        'camps' => 'Camps',
                        'camps.show' => 'Individual Camp',
                        'regulations' => 'Regulations',
                        'regulations.show' => 'Individual Regulation',
                        'appointments.create' => 'Book Appointment',
                        'contact' => 'Contact',
                        'pricing' => 'Pricing',
                        'privacy-policy' => 'Privacy Policy',
                    ])
                    ->required()
                    ->searchable(),
                Forms\Components\FileUpload::make('image_path')
                    ->label('Header Image')
                    ->image()
                    ->directory('header-images')
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
                Tables\Columns\TextColumn::make('route_name')
                    ->label('Route/Page')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Image'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListHeaderImages::route('/'),
            'create' => Pages\CreateHeaderImage::route('/create'),
            'edit' => Pages\EditHeaderImage::route('/{record}/edit'),
        ];
    }
}
