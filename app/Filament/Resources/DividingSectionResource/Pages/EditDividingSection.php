<?php

namespace App\Filament\Resources\DividingSectionResource\Pages;

use App\Filament\Resources\DividingSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDividingSection extends EditRecord
{
    protected static string $resource = DividingSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
