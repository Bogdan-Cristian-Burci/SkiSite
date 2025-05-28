<?php

namespace App\Filament\Resources\WebcamResource\Pages;

use App\Filament\Resources\WebcamResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebcam extends EditRecord
{
    protected static string $resource = WebcamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
