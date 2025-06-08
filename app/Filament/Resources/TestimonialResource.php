<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Filament\Resources\TestimonialResource\RelationManagers;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestimonialResource extends Resource
{
    use Translatable;
    
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    
    protected static ?string $navigationGroup = 'Content';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('author_name')
                            ->label('Author Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Toggle::make('approved_status')
                            ->label('Approved')
                            ->default(false)
                            ->helperText('Toggle to approve or reject this testimonial'),
                    ])->columns(2),
                
                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\Textarea::make('content.en')
                            ->label('Content (English)')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('content.ro')
                            ->label('Content (Romanian)')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('author_name')
                    ->label('Author Name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                Tables\Columns\TextColumn::make('content')
                    ->label('Content')
                    ->getStateUsing(function ($record) {
                        $locale = app()->getLocale();
                        return $record->getTranslation('content', $locale) ?? $record->getTranslation('content', 'en');
                    })
                    ->limit(100)
                    ->searchable()
                    ->wrap(),
                Tables\Columns\IconColumn::make('approved_status')
                    ->label('Approved')
                    ->boolean()
                    ->sortable()
                    ->action(
                        Tables\Actions\Action::make('toggleApproval')
                            ->label(fn ($record) => $record->approved_status ? 'Disapprove' : 'Approve')
                            ->icon(fn ($record) => $record->approved_status ? 'heroicon-o-x-mark' : 'heroicon-o-check')
                            ->color(fn ($record) => $record->approved_status ? 'danger' : 'success')
                            ->action(function ($record) {
                                $record->update(['approved_status' => !$record->approved_status]);
                            })
                            ->requiresConfirmation()
                    ),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('approved_status')
                    ->label('Approval Status')
                    ->options([
                        1 => 'Approved',
                        0 => 'Not Approved',
                    ])
                    ->placeholder('All Testimonials'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
