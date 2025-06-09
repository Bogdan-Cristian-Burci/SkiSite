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
        .info-box { background: #d1ecf1; padding: 15px; border-left: 4px solid #17a2b8; margin: 15px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ __('Registration Cancelled') }}</h1>
        </div>
        
        <div class="content">
            <p>{{ __('Hello') }} {{ $user->name }},</p>
            
            <p>{{ __('We have successfully cancelled your camp registration as requested.') }}</p>
            
            <div class="camp-details">
                <h3>{{ __('Cancelled Registration Details:') }}</h3>
                
                <div class="detail-row">
                    <span class="label">{{ __('Camp:') }}</span> {{ $camp->getTranslation('title', app()->getLocale()) }}
                </div>
                
                <div class="detail-row">
                    <span class="label">{{ __('Location:') }}</span> {{ $camp->getTranslation('location', app()->getLocale()) }}
                </div>
                
                <div class="detail-row">
                    <span class="label">{{ __('Camp Dates:') }}</span> {{ $camp->start_date->format('F j, Y') }} - {{ $camp->end_date->format('F j, Y') }}
                </div>
                
                <div class="detail-row">
                    <span class="label">{{ __('Cancelled:') }}</span> {{ now()->format('F j, Y \a\t g:i A') }}
                </div>
            </div>
            
            <div class="info-box">
                <p><strong>{{ __('What happens next?') }}</strong></p>
                <ul>
                    <li>{{ __('Your registration has been completely removed from our system') }}</li>
                    <li>{{ __('Your spot is now available for other participants') }}</li>
                    <li>{{ __('If you paid any fees, our team will contact you regarding refunds') }}</li>
                    <li>{{ __('You can register for other camps anytime from our website') }}</li>
                </ul>
            </div>
            
            <p>{{ __('We\'re sorry to see you go! If you have any feedback about why you cancelled or if there\'s anything we could have done better, please don\'t hesitate to contact us.') }}</p>
            
            <p>{{ __('We hope to see you at one of our future camps!') }}</p>
            
            <p>{{ __('Best regards,') }}<br>{{ __('The SkiUp Ski School Team') }}</p>
        </div>
        
        <div class="footer">
            <p>{{ __('SkiUp Ski School') }}</p>
            <p>{{ __('Thank you for considering us for your skiing adventure!') }}</p>
        </div>
    </div>
</body>
</html>