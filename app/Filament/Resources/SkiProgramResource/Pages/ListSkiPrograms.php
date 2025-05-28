<?php

namespace App\Filament\Resources\SkiProgramResource\Pages;

use App\Filament\Resources\SkiProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSkiPrograms extends ListRecords
{
    protected static string $resource = SkiProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
