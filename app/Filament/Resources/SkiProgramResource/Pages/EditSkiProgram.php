<?php

namespace App\Filament\Resources\SkiProgramResource\Pages;

use App\Filament\Resources\SkiProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSkiProgram extends EditRecord
{
    protected static string $resource = SkiProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
