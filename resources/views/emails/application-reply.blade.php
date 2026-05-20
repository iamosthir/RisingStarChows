<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reply from RisingStarChows</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #1a1a1a;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        }
        .header {
            background: linear-gradient(135deg, #c41e3a 0%, #8b0000 100%);
            padding: 48px 32px;
            text-align: center;
            position: relative;
        }
        .header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #d4af37, #ffd700, #d4af37);
        }
        .logo {
            font-size: 32px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
        }
        .header-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            font-weight: 500;
        }
        .content {
            padding: 40px 32px;
        }
        .greeting {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 16px;
        }
        .intro-text {
            font-size: 16px;
            color: #4a4a4a;
            margin-bottom: 32px;
            line-height: 1.8;
        }
        .card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }
        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #c41e3a;
        }
        .message-content {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #c41e3a;
            font-size: 15px;
            color: #1a1a1a;
            line-height: 1.8;
        }
        .app-reference {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            border-left: 4px solid #0284c7;
            border-radius: 8px;
            padding: 16px 20px;
            margin: 24px 0;
            font-size: 14px;
            color: #0c4a6e;
        }
        .app-reference strong {
            color: #075985;
            font-weight: 600;
        }
        .btn-primary {
            display: inline-block;
            padding: 16px 40px;
            background: linear-gradient(135deg, #c41e3a 0%, #8b0000 100%);
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            text-align: center;
            margin-top: 24px;
            box-shadow: 0 4px 12px rgba(196, 30, 58, 0.3);
        }
        .cta-container {
            text-align: center;
            margin-top: 32px;
        }
        .footer {
            background: #1a1a1a;
            padding: 32px;
            text-align: center;
            color: #9ca3af;
        }
        .footer-brand {
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 8px;
        }
        .footer-tagline {
            font-size: 14px;
            color: #d4af37;
            margin-bottom: 16px;
            font-weight: 500;
        }
        .footer-text {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.6;
        }
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
            margin: 24px 0;
        }
        @media only screen and (max-width: 600px) {
            body {
                padding: 0;
            }
            .email-container {
                border-radius: 0;
            }
            .content {
                padding: 32px 20px;
            }
            .header {
                padding: 40px 20px;
            }
            .card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="logo">RisingStarChows</div>
            <div class="header-subtitle">Premium Chow Chow Breeders</div>
        </div>

        <!-- Main Content -->
        <div class="content">
            <h1 class="greeting">Hello {{ $application->user_name }}! 👋</h1>
            <p class="intro-text">
                We have a new message for you regarding your reservation application.
            </p>

            <!-- Application Reference -->
            <div class="app-reference">
                <strong>Application Reference:</strong> #{{ $application->id }}<br>
                @if($application->pet)
                    <strong>Interested In:</strong> {{ $application->pet->call_name ?? $application->pet->full_name }}
                @endif
            </div>

            <!-- Admin Message -->
            <div class="card">
                <h2 class="card-title">Message from Our Team</h2>
                <div class="message-content">
                    {!! $adminMessage->message_html !!}
                </div>
                <p style="margin-top: 16px; font-size: 14px; color: #6b7280;">
                    <strong>Sent:</strong> {{ $adminMessage->formatted_sent_at }}
                </p>
            </div>

            <div class="divider"></div>

            <p class="intro-text" style="margin-bottom: 16px; text-align: center;">
                <strong>💬 Have more questions?</strong><br>
                Simply reply to this email and we'll get back to you promptly!
            </p>

            <!-- CTA Button -->
            <div class="cta-container">
                <a href="{{ url('/') }}" class="btn-primary">Visit Our Website</a>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-brand">RisingStarChows</div>
            <div class="footer-tagline">Where Champions Are Born & Raised</div>
            <div class="footer-text">
                This is a message regarding your reservation application.<br>
                <strong>Reply to this email to continue the conversation.</strong>
            </div>
        </div>
    </div>
</body>
</html>
