{{-- resources/views/emails/contact-reply.blade.php --}}

<!DOCTYPE html>
<html lang="en" dir="auto">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #f4f4f5;
            margin: 0;
            padding: 20px;
            color: #111827;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .header {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            padding: 30px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
        }
        .body-content {
            padding: 30px;
        }
        .greeting {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 15px;
        }
        .message-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-left: 4px solid #6366f1;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            font-size: 15px;
            line-height: 1.8;
            color: #111827;
            white-space: pre-wrap;
            direction: auto;
            text-align: start;
        }
        .original-box {
            background: #fefce8;
            border: 1px solid #fde68a;
            border-left: 4px solid #f59e0b;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            font-size: 14px;
            line-height: 1.7;
            color: #374151;
        }
        .original-label {
            font-size: 12px;
            font-weight: 700;
            color: #92400e;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        .footer {
            background: #f9fafb;
            padding: 20px 30px;
            text-align: center;
            font-size: 13px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="header">
            <h1>{{ config('app.name') }}</h1>
        </div>

        <div class="body-content">

            <p class="greeting">
                {{ __('message.dear') }} {{ $contact->name }},
            </p>

            <p style="color: #374151; font-size: 15px;">
                {{ __('message.reply_email_intro') }}
            </p>

            {{-- Reply Message --}}
            <div class="message-box">{{ $reply->message }}</div>

            {{-- Original Message --}}
            <div class="original-label">{{ __('message.your_original_message') }}:</div>
            <div class="original-box">
                <strong>{{ __('message.subject') }}:</strong> {{ $contact->subject }}<br><br>
                {{ $contact->message }}
            </div>

            <p style="color: #6b7280; font-size: 14px; margin-top: 20px;">
                {{ __('message.reply_email_footer') }}
            </p>

        </div>

        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('message.all_rights_reserved') }}
        </div>

    </div>
</body>
</html>