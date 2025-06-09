<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentContactsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    
    protected static ?string $heading = 'Recent Contact Messages';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Contact::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->label('Subject')
                    ->limit(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->icon('heroicon-m-eye')
                    ->url(fn (Contact $record): string => route('filament.admin.resources.contacts.view', $record)),
            ]);
    }
}