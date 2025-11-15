<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
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
            animation: swing 2s ease-in-out infinite;
        }
        @keyframes swing {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(10deg); }
            75% { transform: rotate(-10deg); }
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
        .reset-button {
            display: inline-block;
            padding: 16px 40px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.3);
        }
        .reset-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(59, 130, 246, 0.4);
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .warning-box {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .warning-box p {
            margin: 0;
            color: #92400e;
            font-size: 14px;
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
        .link-text {
            word-break: break-all;
            font-size: 12px;
            color: #9ca3af;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <span class="emoji">🔑</span>
            <h1>Password Reset Request</h1>
        </div>

        <div class="content">
            <p class="greeting">Hello {{ $user->name }},</p>

            <p class="message">
                You requested to reset your password for your Banana Catcher account.
                Click the button below to create a new password. This link will expire in
                <strong>{{ $expiresIn }} minutes</strong>.
            </p>

            <div class="button-container">
                <a href="{{ $resetUrl }}" class="reset-button">Reset Password</a>
            </div>

            <div class="warning-box">
                <p>
                    <strong>Important:</strong> If you did not request this password reset,
                    please ignore this email or contact support if you have security concerns.
                </p>
            </div>

            <div class="info-box">
                <p><strong>Password Requirements:</strong></p>
                <p>• At least 8 characters long</p>
                <p>• Include uppercase and lowercase letters</p>
                <p>• Include numbers and special characters</p>
                <p>• Use a unique password for this account</p>
            </div>

            <p class="link-text">
                If the button doesn't work, copy and paste this link into your browser:<br>
                {{ $resetUrl }}
            </p>
        </div>

        <div class="footer">
            <p><strong>Banana Catcher</strong></p>
            <p>Account Security Team</p>
            <p style="margin-top: 15px;">
                <a href="#">Privacy Policy</a> |
                <a href="#">Terms of Service</a> |
                <a href="#">Support</a>
            </p>
            <p style="margin-top: 15px; font-size: 12px; color: #9ca3af;">
                This is an automated security email.
            </p>
        </div>
    </div>
</body>
</html>
