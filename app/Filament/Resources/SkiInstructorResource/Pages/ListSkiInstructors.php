<?php

namespace App\Filament\Resources\SkiInstructorResource\Pages;

use App\Filament\Resources\SkiInstructorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSkiInstructors extends ListRecords
{
    protected static string $resource = SkiInstructorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
