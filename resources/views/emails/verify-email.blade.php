<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email Address</title>
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
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            padding: 40px 20px;
            text-align: center;
        }
        .header .emoji {
            font-size: 48px;
            display: block;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: white;
            font-size: 28px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-weight: bold;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #1f2937;
            margin-bottom: 20px;
            font-weight: 500;
        }
        .message {
            font-size: 16px;
            color: #4b5563;
            margin-bottom: 20px;
            line-height: 1.6;
        }
        .verify-button {
            display: inline-block;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            margin: 20px 0;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .verify-button:hover {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .info-box {
            background: #fef3c7;
            border: 1px solid #fbbf24;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .info-box h3 {
            margin: 0 0 10px 0;
            color: #92400e;
            font-size: 16px;
        }
        .info-box p {
            margin: 5px 0;
            font-size: 14px;
            color: #92400e;
        }
        .warning-box {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .warning-box p {
            margin: 5px 0;
            font-size: 14px;
            color: #991b1b;
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
            color: #f59e0b;
            text-decoration: none;
        }
        .link-text {
            word-break: break-all;
            font-size: 12px;
            color: #9ca3af;
            margin-top: 20px;
            padding: 15px;
            background: #f9fafb;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <span class="emoji">📧</span>
            <h1>Verify Your Email Address</h1>
        </div>

        <div class="content">
            <p class="greeting">Dear {{ $notifiable->name }},</p>

            <p class="message">
                Thank you for registering with Banana Catcher. To complete your account setup
                and begin using our educational platform, please verify your email address.
            </p>

            <p class="message">
                Use the following One-Time Password (OTP) to verify your email address.
                This OTP will expire in 15 minutes.
            </p>

            <div class="button-container">
                <div style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); color: white; padding: 20px; border-radius: 8px; font-size: 32px; font-weight: bold; letter-spacing: 8px; text-align: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    {{ $otp }}
                </div>
                <p style="margin-top: 15px; font-size: 14px; color: #6b7280;">Enter this code on the verification page</p>
            </div>

            <div class="info-box">
                <h3>Account Verification Benefits</h3>
                <p>• Secure access to your learning progress</p>
                <p>• Important account notifications and updates</p>
                <p>• Password recovery assistance when needed</p>
                <p>• Full access to platform features and statistics</p>
            </div>

            <div class="warning-box">
                <p>
                    <strong>Important Information:</strong> If you did not create an account with Banana Catcher,
                    please disregard this message. No account will be activated without email verification.
                </p>
            </div>

            <p class="link-text">
                Your verification code: {{ $otp }}<br>
                This code is valid for 15 minutes only.
            </p>
        </div>

        <div class="footer">
            <p><strong>Banana Catcher Educational Platform</strong></p>
            <p>Account Verification Department</p>
            <p style="margin-top: 15px;">
                <a href="{{ url('/') }}">Visit Website</a> |
                <a href="{{ url('/#/privacy') }}">Privacy Policy</a> |
                <a href="{{ url('/#/terms') }}">Terms of Service</a> |
                <a href="mailto:support@bananacatcher.com">Contact Support</a>
            </p>
            <p style="margin-top: 15px; color: #6b7280; font-size: 12px;">
                This email was sent to {{ $notifiable->email }} for account verification purposes.<br>
                Banana Catcher, LLC, 123 Math Street, Learning City, LC 12345<br>
                © {{ date('Y') }} Banana Catcher. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
