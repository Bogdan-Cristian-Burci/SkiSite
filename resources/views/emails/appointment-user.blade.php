<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointment Request Received</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #2196F3; color: white; padding: 20px; text-align: center; }
        .content { padding: 30px 20px; }
        .appointment-summary { background: #f8f9fa; padding: 20px; border-left: 4px solid #2196F3; margin: 20px 0; }
        .detail-row { margin: 8px 0; }
        .label { font-weight: bold; color: #555; }
        .highlight { background: #e3f2fd; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Appointment Request Received</h1>
        </div>
        
        <div class="content">
            <p>Dear {{ $user->name }},</p>
            
            <p>Thank you for your interest in SkiUp Ski School! We have received your appointment request and our team will review it shortly.</p>
            
            <div class="highlight">
                <strong>What happens next?</strong><br>
                Our team will contact you within <strong>{{ $replyTimeHours }} hours</strong> to confirm your appointment and discuss any specific requirements or preferences you may have.
            </div>
            
            <div class="appointment-summary">
                <h3>Your Appointment Request Summary:</h3>
                
                <div class="detail-row">
                    <span class="label">Dates:</span> {{ $appointment->start_date->format('F j, Y') }} to {{ $appointment->end_date->format('F j, Y') }}
                </div>
                
                <div class="detail-row">
                    <span class="label">Duration:</span> {{ $appointment->start_date->diffInDays($appointment->end_date) + 1 }} day(s)
                </div>
                
                <div class="detail-row">
                    <span class="label">Participants:</span> {{ $appointment->number_of_adults }} adult(s), {{ $appointment->number_of_children }} children
                </div>
                
                <div class="detail-row">
                    <span class="label">Hours per Day:</span> {{ $appointment->hours_per_day }} hour(s)
                </div>
                
                <div class="detail-row">
                    <span class="label">Total Hours:</span> {{ $appointment->hours_per_day * ($appointment->start_date->diffInDays($appointment->end_date) + 1) }} hour(s)
                </div>
            </div>
            
            <p>If you have any questions or need to make changes to your request, please don't hesitate to contact us.</p>
            
            <p>We look forward to helping you improve your skiing skills!</p>
            
            <p>Best regards,<br>
            The SkiUp Ski School Team</p>
        </div>
        
        <div class="footer">
            <p>SkiUp Ski School | Professional Ski Instruction</p>
            <p>If you didn't make this request, please contact us immediately.</p>
        </div>
    </div>
</body>
</html>