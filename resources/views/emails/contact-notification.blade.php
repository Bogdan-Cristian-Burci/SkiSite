<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Contact Form Submission</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #ff5722; color: white; padding: 20px; text-align: center; }
        .content { padding: 30px 20px; }
        .contact-details { background: #f8f9fa; padding: 20px; border-left: 4px solid #ff5722; margin: 20px 0; }
        .detail-row { margin: 12px 0; }
        .label { font-weight: bold; color: #555; }
        .message-content { background: #fff3e0; padding: 15px; border-radius: 5px; margin: 15px 0; }
        .action-buttons { text-align: center; margin: 30px 0; }
        .btn { display: inline-block; padding: 12px 24px; background: #ff5722; color: white; text-decoration: none; border-radius: 5px; margin: 0 10px; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 14px; }
        .urgent { background: #ffebee; border: 1px solid #f44336; padding: 10px; border-radius: 5px; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚨 New Contact Form Submission</h1>
        </div>
        
        <div class="content">
            <p>Hello Admin,</p>
            
            <p>A new contact form submission has been received through the SkiUp website. Please review the details below and respond accordingly.</p>
            
            @if($contact->category === 'support')
            <div class="urgent">
                <strong>⚠️ Support Request:</strong> This message is categorized as a support request and may require urgent attention.
            </div>
            @endif
            
            <div class="contact-details">
                <h3>Contact Details:</h3>
                
                <div class="detail-row">
                    <span class="label">Name:</span> {{ $contact->name }}
                </div>
                
                <div class="detail-row">
                    <span class="label">Email:</span> 
                    <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                </div>
                
                <div class="detail-row">
                    <span class="label">Subject:</span> {{ $contact->subject }}
                </div>
                
                <div class="detail-row">
                    <span class="label">Category:</span> 
                    <span style="background: #e3f2fd; padding: 4px 8px; border-radius: 3px;">{{ ucfirst($contact->category) }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="label">Submitted:</span> {{ $contact->created_at->format('F j, Y \a\t g:i A') }}
                </div>
                
                <div class="detail-row">
                    <span class="label">Status:</span> 
                    <span style="background: #4caf50; color: white; padding: 4px 8px; border-radius: 3px;">{{ ucfirst($contact->status) }}</span>
                </div>
            </div>
            
            <div class="message-content">
                <div class="label">Message:</div>
                <p style="margin-top: 10px; white-space: pre-wrap;">{{ $contact->message }}</p>
            </div>
            
            <div class="action-buttons">
                <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="btn">Reply via Email</a>
                <a href="{{ config('app.url') }}/admin/contacts/{{ $contact->id }}" class="btn" style="background: #2196F3;">View in Dashboard</a>
            </div>
            
            <p><strong>Next Steps:</strong></p>
            <ul>
                <li>Review the contact details and message content</li>
                <li>Update the status in the admin dashboard</li>
                <li>Respond to the customer within {{ config('mail.contact_replay_time', 2) }} business days</li>
                <li>Mark as resolved once the inquiry has been handled</li>
            </ul>
            
            <p>Best regards,<br>
            SkiUp Ski School System</p>
        </div>
        
        <div class="footer">
            <p>SkiUp Ski School Admin Panel | This is an automated notification</p>
            <p>Contact ID: #{{ $contact->id }}</p>
        </div>
    </div>
</body>
</html>