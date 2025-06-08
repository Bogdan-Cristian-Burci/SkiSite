<?php

namespace App\Filament\Resources\DividingSectionResource\Pages;

use App\Filament\Resources\DividingSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDividingSections extends ListRecords
{
    protected static string $resource = DividingSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
