<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Your Camp Registration Updated') }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #2196F3; color: white; padding: 20px; text-align: center; }
        .content { padding: 30px 20px; }
        .camp-details { background: #f8f9fa; padding: 20px; border-left: 4px solid #2196F3; margin: 20px 0; }
        .detail-row { margin: 10px 0; }
        .label { font-weight: bold; color: #555; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 14px; }
        .success-box { background: #d4edda; padding: 15px; border-left: 4px solid #28a745; margin: 15px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ __('Registration Updated Successfully') }}</h1>
        </div>
        
        <div class="content">
            <p>{{ __('Hello') }} {{ $user->name }},</p>
            
            <div class="success-box">
                <p><strong>{{ __('Your camp registration has been updated successfully!') }}</strong></p>
            </div>
            
            <p>{{ __('Here are your updated registration details:') }}</p>
            
            <div class="camp-details">
                <h3>{{ __('Camp Details:') }}</h3>
                
                <div class="detail-row">
                    <span class="label">{{ __('Camp:') }}</span> {{ $camp->getTranslation('title', app()->getLocale()) }}
                </div>
                
                <div class="detail-row">
                    <span class="label">{{ __('Location:') }}</span> {{ $camp->getTranslation('location', app()->getLocale()) }}
                </div>
                
                <div class="detail-row">
                    <span class="label">{{ __('Camp Dates:') }}</span> {{ $camp->start_date->format('F j, Y') }} - {{ $camp->end_date->format('F j, Y') }}
                </div>
                
                @php
                    $registration = $user->camps()->where('camp_id', $camp->id)->first();
                @endphp
                
                <div class="detail-row">
                    <span class="label">{{ __('Adults:') }}</span> {{ $registration->pivot->number_of_adults }}
                </div>
                
                <div class="detail-row">
                    <span class="label">{{ __('Children:') }}</span> {{ $registration->pivot->number_of_children }}
                </div>
                
                <div class="detail-row">
                    <span class="label">{{ __('Total People:') }}</span> {{ $registration->pivot->number_of_adults + $registration->pivot->number_of_children }}
                </div>
                
                <div class="detail-row">
                    <span class="label">{{ __('Updated:') }}</span> {{ now()->format('F j, Y \a\t g:i A') }}
                </div>
            </div>
            
            <p>{{ __('If you have any questions or need to make further changes, please contact us or visit your dashboard.') }}</p>
            
            <p>{{ __('We look forward to seeing you at the camp!') }}</p>
            
            <p>{{ __('Best regards,') }}<br>{{ __('The SkiUp Ski School Team') }}</p>
        </div>
        
        <div class="footer">
            <p>{{ __('SkiUp Ski School') }}</p>
            <p>{{ __('Thank you for choosing us for your skiing adventure!') }}</p>
        </div>
    </div>
</body>
</html>