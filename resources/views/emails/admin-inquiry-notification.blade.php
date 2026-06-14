<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New {{ $sourceType }}</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f5f5f5; padding: 24px; color: #222;">
    <div style="max-width: 640px; margin: 0 auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
        <div style="background: #8b0000; color: #fff; padding: 20px 28px;">
            <h2 style="margin: 0; font-size: 20px;">New {{ $sourceType }}</h2>
            <p style="margin: 4px 0 0; opacity: 0.85; font-size: 13px;">Received {{ now()->format('M j, Y \a\t g:i A') }}</p>
        </div>

        <div style="padding: 24px 28px;">
            <p style="margin-top: 0;">A new inquiry has come in through the website.</p>

            <table style="width: 100%; border-collapse: collapse; margin: 16px 0;">
                <tr>
                    <td style="padding: 8px 0; width: 130px; color: #666; vertical-align: top;">Name</td>
                    <td style="padding: 8px 0; font-weight: 600;">{{ $senderName }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: #666; vertical-align: top;">Email</td>
                    <td style="padding: 8px 0;"><a href="mailto:{{ $senderEmail }}" style="color: #8b0000; text-decoration: none;">{{ $senderEmail }}</a></td>
                </tr>
                @if($senderPhone)
                <tr>
                    <td style="padding: 8px 0; color: #666; vertical-align: top;">Phone</td>
                    <td style="padding: 8px 0;">{{ $senderPhone }}</td>
                </tr>
                @endif
                @if($topic)
                <tr>
                    <td style="padding: 8px 0; color: #666; vertical-align: top;">Subject</td>
                    <td style="padding: 8px 0;">{{ $topic }}</td>
                </tr>
                @endif
                @if($pet)
                <tr>
                    <td style="padding: 8px 0; color: #666; vertical-align: top;">About Dog</td>
                    <td style="padding: 8px 0;">
                        <strong>{{ $pet->call_name ?? $pet->full_name }}</strong>
                        @if($pet->category)
                            <span style="color: #888;"> &mdash; {{ $pet->category }}</span>
                        @endif
                    </td>
                </tr>
                @endif
            </table>

            <div style="border-top: 1px solid #eee; padding-top: 16px;">
                <p style="margin: 0 0 6px; color: #666;">Message</p>
                <div style="background: #fafafa; border-left: 3px solid #8b0000; padding: 12px 14px; white-space: pre-wrap;">{{ $messageBody }}</div>
            </div>

            <p style="margin-top: 24px; font-size: 13px; color: #888;">
                Tip: hit "Reply" in your mail client to respond directly to {{ $senderName }}.
            </p>
        </div>
    </div>
</body>
</html>
