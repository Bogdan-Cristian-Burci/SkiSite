<?php

namespace App\Filament\Resources\PopularDestinationResource\Pages;

use App\Filament\Resources\PopularDestinationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPopularDestinations extends ListRecords
{
    protected static string $resource = PopularDestinationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
