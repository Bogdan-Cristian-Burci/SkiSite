<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use App\Mail\ContactReply;
use App\Models\Contact;
use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Mail;

class ViewContact extends ViewRecord
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('reply')
                ->label('Reply')
                ->icon('heroicon-o-arrow-uturn-left')
                ->color('success')
                ->form([
                    Forms\Components\TextInput::make('to')
                        ->label('To')
                        ->default($this->record->email)
                        ->disabled()
                        ->required(),
                    Forms\Components\TextInput::make('subject')
                        ->label('Subject')
                        ->default('RE: ' . $this->record->subject)
                        ->required(),
                    Forms\Components\Textarea::make('message')
                        ->label('Message')
                        ->required()
                        ->rows(10)
                        ->placeholder('Type your reply here...'),
                ])
                ->action(function (array $data) {
                    try {
                        // Send email using the ContactReply mailable
                        Mail::send(new ContactReply($this->record, $data['message'], $data['subject']));

                        // Update contact status to replied
                        $this->record->update(['status' => 'replied']);

                        Notification::make()
                            ->title('Reply sent successfully!')
                            ->body('Email sent to ' . $this->record->email)
                            ->success()
                            ->send();

                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Failed to send reply')
                            ->body('Error: ' . $e->getMessage())
                            ->danger()
                            ->send();
                    }
                })
                ->modalHeading('Reply to Contact Message')
                ->modalDescription('Send a reply to ' . $this->record->name . ' (' . $this->record->email . ')')
                ->modalSubmitActionLabel('Send Reply')
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Mark the contact as read when viewing
        if ($this->record->status === 'new') {
            $this->record->update(['status' => 'read']);
        }

        return $data;
    }
}