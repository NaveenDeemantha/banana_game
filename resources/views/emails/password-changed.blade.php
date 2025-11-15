<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Changed Successfully</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 40px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            color: white;
            font-size: 28px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .emoji {
            font-size: 48px;
            display: block;
            margin-bottom: 10px;
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #1f2937;
            margin-bottom: 20px;
        }
        .message {
            font-size: 16px;
            color: #4b5563;
            margin-bottom: 30px;
        }
        .success-box {
            background: #d1fae5;
            border-left: 4px solid #10b981;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .success-box p {
            margin: 5px 0;
            color: #065f46;
            font-size: 15px;
        }
        .info-box {
            background: #f3f4f6;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .info-box p {
            margin: 5px 0;
            font-size: 14px;
            color: #6b7280;
        }
        .info-box strong {
            color: #1f2937;
        }
        .warning-box {
            background: #fee2e2;
            border-left: 4px solid #ef4444;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .warning-box p {
            margin: 5px 0;
            color: #991b1b;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            padding: 14px 32px;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 6px rgba(239, 68, 68, 0.3);
        }
        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(239, 68, 68, 0.4);
        }
        .button-container {
            text-align: center;
            margin: 25px 0;
        }
        .footer {
            background: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer p {
            margin: 5px 0;
            font-size: 14px;
            color: #6b7280;
        }
        .footer a {
            color: #3b82f6;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <span class="emoji">🔐</span>
            <h1>Password Changed Successfully</h1>
        </div>

        <div class="content">
            <p class="greeting">Hello {{ $user->name }},</p>

            <p class="message">
                Your password has been successfully changed. You can now use your new password to log in to your Banana Catcher account.
            </p>

            <div class="success-box">
                <p><strong>✅ Password Updated</strong></p>
                <p>Your account is now secured with your new password.</p>
            </div>

            <div class="info-box">
                <p><strong>Change Details:</strong></p>
                <p><strong>Time:</strong> {{ $changedAt }}</p>
                <p><strong>IP Address:</strong> {{ $ipAddress }}</p>
                <p><strong>Device:</strong> {{ $userAgent }}</p>
            </div>

            <div class="warning-box">
                <p><strong>⚠️ Didn't change your password?</strong></p>
                <p>
                    If you did not make this change, your account may be compromised.
                    Please secure your account immediately by clicking the button below.
                </p>
            </div>

            <div class="button-container">
                <a href="{{ url(route('password.request')) }}" class="button">
                    Reset Password Immediately
                </a>
            </div>

            <div class="info-box">
                <p><strong>Security Reminders:</strong></p>
                <p>✅ Never share your password with anyone</p>
                <p>✅ Use a unique password for each account</p>
                <p>✅ Update your password regularly</p>
                <p>✅ Enable two-factor authentication if available</p>
            </div>
        </div>

        <div class="footer">
            <p><strong>🍌 Banana Catcher</strong></p>
            <p>Catch bananas, beat your high score!</p>
            <p style="margin-top: 15px;">
                <a href="#">Privacy Policy</a> |
                <a href="#">Terms of Service</a> |
                <a href="#">Contact Support</a>
            </p>
            <p style="margin-top: 15px; font-size: 12px; color: #9ca3af;">
                This is an automated email. Please do not reply to this message.
            </p>
        </div>
    </div>
</body>
</html>
