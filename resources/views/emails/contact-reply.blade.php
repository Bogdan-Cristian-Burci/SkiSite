<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Your Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
            margin: -20px -20px 20px -20px;
        }
        .content {
            padding: 20px 0;
        }
        .original-message {
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
            <p>Reply to Your Message</p>
        </div>
        
        <div class="content">
            <p>Dear {{ $contact->name }},</p>
            
            <p>Thank you for contacting us. Here is our reply to your message:</p>
            
            <div style="background-color: #ffffff; border: 1px solid #ddd; padding: 20px; border-radius: 4px; margin: 20px 0;">
                {!! nl2br(e($replyMessage)) !!}
            </div>
            
            <div class="original-message">
                <h4>Your Original Message:</h4>
                <p><strong>Subject:</strong> {{ $contact->subject }}</p>
                <p><strong>Date:</strong> {{ $contact->created_at->format('F j, Y \a\t g:i A') }}</p>
                <p><strong>Message:</strong></p>
                <p>{{ $contact->message }}</p>
            </div>
            
            <p>If you have any further questions, please don't hesitate to contact us.</p>
            
            <p>Best regards,<br>
            {{ config('app.name') }} Team</p>
        </div>
        
        <div class="footer">
            <p>This is an automated response to your contact form submission. Please do not reply directly to this email.</p>
        </div>
    </div>
</body>
</html>