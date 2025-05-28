<?php

namespace App\Filament\Resources\CategoriesResource\Pages;

use App\Filament\Resources\CategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New Category'),
        ];
    }
    
    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Categories'),
            'with_posts' => Tab::make('With Posts')
                ->modifyQueryUsing(fn (Builder $query) => $query->has('blogPosts')),
            'empty' => Tab::make('Empty Categories')
                ->modifyQueryUsing(fn (Builder $query) => $query->doesntHave('blogPosts')),
        ];
    }
}
