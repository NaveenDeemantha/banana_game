<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Login Alert</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #F3F4F6;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
            padding: 30px;
            text-align: center;
        }
        .header .emoji {
            font-size: 60px;
            margin-bottom: 10px;
        }
        .header h1 {
            color: white;
            margin: 10px 0;
            font-size: 26px;
        }
        .content {
            padding: 40px 30px;
            color: #333;
        }
        .greeting {
            font-size: 20px;
            color: #1D4ED8;
            margin-bottom: 20px;
        }
        .alert-box {
            background: #DBEAFE;
            border-left: 4px solid #3B82F6;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        .alert-box h3 {
            color: #1E40AF;
            margin-top: 0;
            font-size: 18px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #E0E7FF;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: 600;
            color: #4B5563;
        }
        .info-value {
            color: #1F2937;
            text-align: right;
        }
        .warning-box {
            background: #FEF3C7;
            border: 1px solid #FCD34D;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        .warning-box strong {
            color: #D97706;
        }
        .secure-button {
            display: inline-block;
            background: #EF4444;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 15px;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);
        }
        .footer {
            background: #F9FAFB;
            padding: 25px;
            text-align: center;
            color: #6B7280;
            font-size: 13px;
        }
        .security-tips {
            background: #F0FDF4;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .security-tips h4 {
            color: #15803D;
            margin-top: 0;
        }
        .security-tips ul {
            margin: 10px 0;
            padding-left: 20px;
            color: #166534;
        }
        .security-tips li {
            margin: 8px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="emoji">🔐</div>
            <h1>Account Login Notification</h1>
        </div>

        <div class="content">
            <div class="greeting">Dear {{ $user->name }},</div>

            <p>We are writing to inform you of a recent login to your Banana Catcher account.</p>

            <div class="alert-box">
                <h3>Login Information</h3>

                <div class="info-row">
                    <span class="info-label">Time:</span>
                    <span class="info-value">{{ $loginTime }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">IP Address:</span>
                    <span class="info-value">{{ $ipAddress }}</span>
                </div>

                @if($userAgent)
                <div class="info-row">
                    <span class="info-label">Device/Browser:</span>
                    <span class="info-value">{{ $userAgent }}</span>
                </div>
                @endif

                <div class="info-row">
                    <span class="info-label">Account:</span>
                    <span class="info-value">{{ $user->email }}</span>
                </div>
            </div>

            <div class="warning-box">
                <strong>Account Security Information</strong>
                <p style="margin: 10px 0 0;">
                    If this login was authorized by you, no further action is required. Your account remains secure.
                </p>
                <p style="margin: 10px 0 0;">
                    If this login was not authorized by you, we recommend that you change your password immediately to secure your account.
                </p>
                <center>
                    <a href="{{ url(route('password.request')) }}" class="secure-button">
                        Change Account Password
                    </a>
                </center>
            </div>

            <div class="security-tips">
                <h4>Account Security Best Practices:</h4>
                <ul>
                    <li>Use a strong, unique password for your account</li>
                    <li>Do not share your login credentials with others</li>
                    <li>Log out from public or shared computers after use</li>
                    <li>Change your password periodically for enhanced security</li>
                    <li>Enable additional security features when they become available</li>
                </ul>
            </div>

            <p style="font-size: 14px; color: #6B7280; margin-top: 30px;">
                This notification helps protect your account security. If you have concerns, please contact our support team.
            </p>
        </div>

        <div class="footer">
            <p><strong>Need Assistance?</strong></p>
            <p>Contact our support team for help with your account.</p>
            <p style="margin-top: 20px; color: #9CA3AF; font-size: 12px;">
                © {{ date('Y') }} Banana Catcher. All rights reserved.<br>
                This is an automated security notification.
            </p>
        </div>
    </div>
</body>
</html>
