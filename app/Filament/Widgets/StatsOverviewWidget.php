<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Appointment;
use App\Models\BlogPost;
use App\Models\Camp;
use App\Models\Contact;
use App\Models\SkiInstructor;
use App\Models\SkiProgram;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('All registered users')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
            
            Stat::make('Active Appointments', Appointment::count())
                ->description('Scheduled appointments')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info'),
            
            Stat::make('Blog Posts', BlogPost::count())
                ->description('Published articles')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning'),
            
            Stat::make('Available Camps', Camp::count())
                ->description('Active ski camps')
                ->descriptionIcon('heroicon-m-home-modern')
                ->color('primary'),
            
            Stat::make('Contact Messages', Contact::count())
                ->description('Received inquiries')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('danger'),
            
            Stat::make('Ski Instructors', SkiInstructor::count())
                ->description('Available instructors')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),
        ];
    }
}