<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentAppointmentsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    
    protected static ?string $heading = 'Recent Appointments';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Appointment::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Client')
                    ->searchable(),
                Tables\Columns\TextColumn::make('instructor.name')
                    ->label('Instructor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time')
                    ->label('Time'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Booked At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->icon('heroicon-m-eye')
                    ->url(fn (Appointment $record): string => route('filament.admin.resources.appointments.view', $record)),
            ]);
    }
}