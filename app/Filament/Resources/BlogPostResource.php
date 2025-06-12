<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Filament\Resources\BlogPostResource\RelationManagers;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogPostResource extends Resource
{
    use Translatable;
    
    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('title.en')
                            ->label('Title (English)')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug.en', \Illuminate\Support\Str::slug($state))),
                        Forms\Components\TextInput::make('title.ro')
                            ->label('Title (Romanian)')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug.ro', \Illuminate\Support\Str::slug($state))),
                        Forms\Components\TextInput::make('slug.en')
                            ->label('Slug (English)')
                            ->required()
                            ->unique(BlogPost::class, 'slug->en', ignoreRecord: true),
                        Forms\Components\TextInput::make('slug.ro')
                            ->label('Slug (Romanian)')
                            ->required()
                            ->unique(BlogPost::class, 'slug->ro', ignoreRecord: true),
                        Forms\Components\TextInput::make('subtitle.en')
                            ->label('Subtitle (English)')
                            ->required(),
                        Forms\Components\TextInput::make('subtitle.ro')
                            ->label('Subtitle (Romanian)')
                            ->required(),
                    ])->columns(2),
                
                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\RichEditor::make('content.en')
                            ->label('Content (English)')
                            ->required()
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ]),
                        Forms\Components\RichEditor::make('content.ro')
                            ->label('Content (Romanian)')
                            ->required()
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ]),
                    ]),
                
                Forms\Components\Section::make('Media')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Featured Image')
                            ->image()
                            ->directory('blog-posts')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->required(),
                        Forms\Components\FileUpload::make('galery')
                            ->label('Gallery Images')
                            ->multiple()
                            ->image()
                            ->directory('blog-posts/gallery')
                            ->imageEditor()
                            ->reorderable(),
                    ]),
                
                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Select::make('categories_id')
                            ->label('Category')
                            ->relationship('categories', 'name')
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                                Forms\Components\Textarea::make('description'),
                            ]),
                        Forms\Components\Hidden::make('user_id')
                            ->default(auth()->id()),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Featured Image')
                    ->size(80)
                    ->square(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        $locale = app()->getLocale();
                        return $record->getTranslation('title', $locale) ?? $record->getTranslation('title', 'en');
                    })
                    ->limit(50),
                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->getStateUsing(function ($record) {
                        $locale = app()->getLocale();
                        return $record->getTranslation('subtitle', $locale) ?? $record->getTranslation('subtitle', 'en');
                    })
                    ->limit(30)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('categories.name')
                    ->label('Category')
                    ->badge()
                    ->color('primary')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Author')
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->getStateUsing(function ($record) {
                        $locale = app()->getLocale();
                        return $record->getTranslation('slug', $locale) ?? $record->getTranslation('slug', 'en');
                    })
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categories_id')
                    ->label('Category')
                    ->relationship('categories', 'name'),
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Author')
                    ->relationship('user', 'name'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->url(fn (BlogPost $record): string => localized_route('blog.show', $record->getTranslation('slug', app()->getLocale())))
                        ->openUrlInNewTab(),
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
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
