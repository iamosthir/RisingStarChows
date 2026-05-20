<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reservation Received - RisingStarChows</title>
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
        .info-grid {
            display: table;
            width: 100%;
        }
        .info-row {
            display: table-row;
        }
        .info-label,
        .info-value {
            display: table-cell;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .info-row:last-child .info-label,
        .info-row:last-child .info-value {
            border-bottom: none;
        }
        .info-label {
            font-weight: 600;
            color: #6b7280;
            width: 35%;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .info-value {
            color: #1a1a1a;
            font-size: 15px;
            font-weight: 500;
        }
        .message-content {
            background: #ffffff;
            padding: 16px;
            border-radius: 8px;
            margin-top: 8px;
            border-left: 3px solid #c41e3a;
            font-size: 15px;
            color: #4a4a4a;
            line-height: 1.7;
        }
        .highlight-card {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border: none;
            border-left: 4px solid #d4af37;
        }
        .highlight-card .card-title {
            color: #92400e;
            border-bottom-color: #d4af37;
        }
        .next-steps {
            list-style: none;
            padding: 0;
            margin: 16px 0 0 0;
        }
        .next-steps li {
            padding: 12px 0;
            color: #78350f;
            font-size: 15px;
            font-weight: 500;
            position: relative;
            padding-left: 32px;
        }
        .next-steps li::before {
            content: '✓';
            position: absolute;
            left: 0;
            top: 12px;
            width: 24px;
            height: 24px;
            background: #d4af37;
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
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
            margin-top: 32px;
            box-shadow: 0 4px 12px rgba(196, 30, 58, 0.3);
            transition: all 0.3s ease;
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
            margin-bottom: 24px;
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
            .info-label,
            .info-value {
                display: block;
                width: 100%;
                padding: 8px 0;
            }
            .info-label {
                padding-bottom: 4px;
            }
            .info-value {
                padding-bottom: 12px;
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
            <h1 class="greeting">Thank You, {{ $application->user_name }}! 🐾</h1>
            <p class="intro-text">
                We're thrilled to receive your reservation application! Your interest in our Chow Chows means the world to us, and we can't wait to help you find your perfect companion.
            </p>

            <!-- Application Reference -->
            <div style="background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%); border-left: 4px solid #0284c7; border-radius: 8px; padding: 16px 20px; margin: 24px 0; font-size: 14px; color: #0c4a6e;">
                <strong style="color: #075985; font-weight: 600;">Application Reference:</strong> #{{ $application->id }}<br>
                <span style="font-size: 13px; color: #0369a1;">Save this reference number for future correspondence</span>
            </div>

            <!-- Application Details Card -->
            <div class="card">
                <h2 class="card-title">Application Summary</h2>
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">Name</div>
                        <div class="info-value">{{ $application->user_name }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $application->email }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Phone</div>
                        <div class="info-value">{{ $application->phone }}</div>
                    </div>
                    @if($application->pet_id && $application->pet)
                    <div class="info-row">
                        <div class="info-label">Interested In</div>
                        <div class="info-value">{{ $application->pet->call_name ?? $application->pet->full_name }}</div>
                    </div>
                    @endif
                    <div class="info-row">
                        <div class="info-label">Submitted</div>
                        <div class="info-value">{{ $application->created_at->format('F j, Y \a\t g:i A') }}</div>
                    </div>
                </div>

                @if($application->inquiry)
                <div style="margin-top: 20px;">
                    <div class="info-label" style="display: block; margin-bottom: 8px;">Your Message</div>
                    <div class="message-content">{{ $application->inquiry }}</div>
                </div>
                @endif
            </div>

            <!-- What's Next Card -->
            <div class="card highlight-card">
                <h2 class="card-title">What Happens Next?</h2>
                <ul class="next-steps">
                    <li>Our team will carefully review your application</li>
                    <li>We'll reach out within 1-2 business days</li>
                    <li>You'll receive updates on your reservation status</li>
                    <li>Feel free to contact us with any questions</li>
                </ul>
            </div>

            <div class="divider"></div>

            <p class="intro-text" style="margin-bottom: 0; text-align: center;">
                We appreciate your patience and look forward to connecting with you soon!
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
                This is an automated confirmation email.<br>
                <strong style="color: #d4af37;">You can reply to this email if you have any questions!</strong>
            </div>
        </div>
    </div>
</body>
</html>
