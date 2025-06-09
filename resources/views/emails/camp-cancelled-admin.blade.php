<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Camp Registration Cancelled') }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #dc3545; color: white; padding: 20px; text-align: center; }
        .content { padding: 30px 20px; }
        .camp-details { background: #f8f9fa; padding: 20px; border-left: 4px solid #dc3545; margin: 20px 0; }
        .detail-row { margin: 10px 0; }
        .label { font-weight: bold; color: #555; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 14px; }
        .warning-box { background: #f8d7da; padding: 15px; border-left: 4px solid #dc3545; margin: 15px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ __('Camp Registration Cancelled') }}</h1>
        </div>
        
        <div class="content">
            <p>{{ __('Hello Admin,') }}</p>
            
            <div class="warning-box">
                <p><strong>{{ __('A camp registration has been cancelled on the SkiUp Ski School website.') }}</strong></p>
            </div>
            
            <div class="camp-details">
                <h3>{{ __('Cancelled Registration Details:') }}</h3>
                
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
                
                <div class="detail-row">
                    <span class="label">{{ __('Cancelled:') }}</span> {{ now()->format('F j, Y \a\t g:i A') }}
                </div>
            </div>
            
            <p>{{ __('The registration has been removed from the system. This will free up spots for other participants.') }}</p>
            
            <p>{{ __('You may want to follow up with the customer to understand the reason for cancellation and offer assistance if needed.') }}</p>
            
            <p>{{ __('You can view the updated camp capacity in the admin panel.') }}</p>
        </div>
        
        <div class="footer">
            <p>{{ __('SkiUp Ski School - Admin Notification System') }}</p>
        </div>
    </div>
</body>
</html>