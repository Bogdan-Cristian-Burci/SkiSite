<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Camp Registration Updated') }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #2196F3; color: white; padding: 20px; text-align: center; }
        .content { padding: 30px 20px; }
        .camp-details { background: #f8f9fa; padding: 20px; border-left: 4px solid #2196F3; margin: 20px 0; }
        .detail-row { margin: 10px 0; }
        .label { font-weight: bold; color: #555; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 14px; }
        .changes { background: #fff3cd; padding: 15px; border-left: 4px solid #ffc107; margin: 15px 0; }
        .old-value { text-decoration: line-through; color: #dc3545; }
        .new-value { color: #28a745; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ __('Camp Registration Updated') }}</h1>
        </div>
        
        <div class="content">
            <p>{{ __('Hello Admin,') }}</p>
            
            <p>{{ __('A camp registration has been updated on the SkiUp Ski School website.') }}</p>
            
            <div class="camp-details">
                <h3>{{ __('Camp Details:') }}</h3>
                
                <div class="detail-row">
                    <span class="label">{{ __('Camp:') }}</span> {{ $camp->getTranslation('title', app()->getLocale()) }}
                </div>
                
                <div class="detail-row">
                    <span class="label">{{ __('Customer:') }}</span> {{ $user->name }}
                </div>
                
                <div class="detail-row">
                    <span class="label">{{ __('Email:') }}</span> {{ $user->email }}
                </div>
                
                @if($user->phone)
                <div class="detail-row">
                    <span class="label">{{ __('Phone:') }}</span> {{ $user->phone }}
                </div>
                @endif
                
                <div class="detail-row">
                    <span class="label">{{ __('Camp Dates:') }}</span> {{ $camp->start_date->format('F j, Y') }} - {{ $camp->end_date->format('F j, Y') }}
                </div>
                
                <div class="detail-row">
                    <span class="label">{{ __('Location:') }}</span> {{ $camp->getTranslation('location', app()->getLocale()) }}
                </div>
            </div>
            
            <div class="changes">
                <h3>{{ __('Registration Changes:') }}</h3>
                
                @php
                    $registration = $user->camps()->where('camp_id', $camp->id)->first();
                @endphp
                
                <div class="detail-row">
                    <span class="label">{{ __('Adults:') }}</span>
                    <span class="old-value">{{ $oldData['number_of_adults'] }}</span> → 
                    <span class="new-value">{{ $registration->pivot->number_of_adults }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="label">{{ __('Children:') }}</span>
                    <span class="old-value">{{ $oldData['number_of_children'] }}</span> → 
                    <span class="new-value">{{ $registration->pivot->number_of_children }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="label">{{ __('Total People:') }}</span>
                    <span class="old-value">{{ $oldData['number_of_adults'] + $oldData['number_of_children'] }}</span> → 
                    <span class="new-value">{{ $registration->pivot->number_of_adults + $registration->pivot->number_of_children }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="label">{{ __('Updated:') }}</span> {{ now()->format('F j, Y \a\t g:i A') }}
                </div>
            </div>
            
            <p>{{ __('You can view and manage this registration in the admin panel.') }}</p>
        </div>
        
        <div class="footer">
            <p>{{ __('SkiUp Ski School - Admin Notification System') }}</p>
        </div>
    </div>
</body>
</html>