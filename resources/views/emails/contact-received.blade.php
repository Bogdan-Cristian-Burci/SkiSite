<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank you for contacting us</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #2196F3; color: white; padding: 20px; text-align: center; }
        .content { padding: 30px 20px; }
        .message-summary { background: #f8f9fa; padding: 20px; border-left: 4px solid #2196F3; margin: 20px 0; }
        .detail-row { margin: 8px 0; }
        .label { font-weight: bold; color: #555; }
        .highlight { background: #e3f2fd; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Message Received</h1>
        </div>
        
        <div class="content">
            <p>Dear {{ $contact->name }},</p>
            
            <p>Thank you for contacting SkiUp Ski School! We have received your message and our team will get back to you as soon as possible.</p>
            
            <div class="highlight">
                <strong>What happens next?</strong><br>
                Our team will respond to your inquiry within <strong>{{ $replyTime }} business days</strong>. We appreciate your patience and look forward to assisting you.
            </div>
            
            <div class="message-summary">
                <h3>Your Message Summary:</h3>
                
                <div class="detail-row">
                    <span class="label">Subject:</span> {{ $contact->subject }}
                </div>
                
                <div class="detail-row">
                    <span class="label">Category:</span> {{ ucfirst($contact->category) }}
                </div>
                
                <div class="detail-row">
                    <span class="label">Message:</span><br>
                    {{ $contact->message }}
                </div>
                
                <div class="detail-row">
                    <span class="label">Submitted on:</span> {{ $contact->created_at->format('F j, Y \a\t g:i A') }}
                </div>
            </div>
            
            <p>If you have any urgent questions or need immediate assistance, please don't hesitate to contact us directly.</p>
            
            <p>Thank you for choosing SkiUp Ski School!</p>
            
            <p>Best regards,<br>
            The SkiUp Ski School Team</p>
        </div>
        
        <div class="footer">
            <p>SkiUp Ski School | Professional Ski Instruction</p>
            <p>If you didn't send this message, please contact us immediately.</p>
        </div>
    </div>
</body>
</html>