<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Appointment Request</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #2196F3; color: white; padding: 20px; text-align: center; }
        .content { padding: 30px 20px; }
        .appointment-details { background: #f8f9fa; padding: 20px; border-left: 4px solid #2196F3; margin: 20px 0; }
        .detail-row { margin: 10px 0; }
        .label { font-weight: bold; color: #555; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Appointment Request</h1>
        </div>
        
        <div class="content">
            <p>Hello Admin,</p>
            
            <p>A new appointment request has been submitted on the SkiUp Ski School website.</p>
            
            <div class="appointment-details">
                <h3>Appointment Details:</h3>
                
                <div class="detail-row">
                    <span class="label">Customer:</span> {{ $user->name }}
                </div>
                
                <div class="detail-row">
                    <span class="label">Email:</span> {{ $user->email }}
                </div>
                
                @if($user->phone)
                <div class="detail-row">
                    <span class="label">Phone:</span> {{ $user->phone }}
                </div>
                @endif
                
                <div class="detail-row">
                    <span class="label">Start Date:</span> {{ $appointment->start_date->format('F j, Y') }}
                </div>
                
                <div class="detail-row">
                    <span class="label">End Date:</span> {{ $appointment->end_date->format('F j, Y') }}
                </div>
                
                <div class="detail-row">
                    <span class="label">Duration:</span> {{ $appointment->start_date->diffInDays($appointment->end_date) + 1 }} day(s)
                </div>
                
                <div class="detail-row">
                    <span class="label">Number of Adults:</span> {{ $appointment->number_of_adults }}
                </div>
                
                <div class="detail-row">
                    <span class="label">Number of Children:</span> {{ $appointment->number_of_children }}
                </div>
                
                <div class="detail-row">
                    <span class="label">Hours per Day:</span> {{ $appointment->hours_per_day }}
                </div>
                
                <div class="detail-row">
                    <span class="label">Total People:</span> {{ $appointment->number_of_adults + $appointment->number_of_children }}
                </div>
                
                <div class="detail-row">
                    <span class="label">Total Hours:</span> {{ $appointment->hours_per_day * ($appointment->start_date->diffInDays($appointment->end_date) + 1) }}
                </div>
                
                <div class="detail-row">
                    <span class="label">Submitted:</span> {{ $appointment->created_at->format('F j, Y \a\t g:i A') }}
                </div>
            </div>
            
            <p>Please review this request and contact the customer within {{ config('appointment.email.reply_time_hours') }} hours.</p>
            
            <p>You can manage this appointment in the admin panel.</p>
        </div>
        
        <div class="footer">
            <p>SkiUp Ski School - Admin Notification System</p>
        </div>
    </div>
</body>
</html>