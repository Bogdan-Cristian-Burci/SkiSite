<?php

namespace App\Filament\Resources\WebcamResource\Pages;

use App\Filament\Resources\WebcamResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebcams extends ListRecords
{
    protected static string $resource = WebcamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
