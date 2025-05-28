<?php

namespace App\Filament\Resources\SkiInstructorResource\Pages;

use App\Filament\Resources\SkiInstructorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSkiInstructor extends EditRecord
{
    protected static string $resource = SkiInstructorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load the user data for the form
        if ($this->record->user) {
            $data['user'] = [
                'name' => $this->record->user->name,
                'email' => $this->record->user->email,
                'phone' => $this->record->user->phone,
            ];
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Handle user phone update
        if (isset($data['user']['phone']) && $this->record->user) {
            $this->record->user->update(['phone' => $data['user']['phone']]);
            unset($data['user']);
        }

        return $data;
    }
}
