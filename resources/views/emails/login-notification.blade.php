<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Login Alert</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: white;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }
        .header {
            background: #F59E0B;
            padding: 30px 20px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 10px 0 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .message {
            font-size: 15px;
            line-height: 1.6;
            color: #333;
            margin-bottom: 20px;
        }
        .info-box {
            background: #f0f0f0;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .info-row {
            padding: 8px 0;
            font-size: 14px;
        }
        .info-label {
            font-weight: bold;
            color: #666;
        }
        .button {
            display: inline-block;
            background: #FBBF24;
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .footer {
            background: #f9f9f9;
            padding: 15px;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div style="font-size: 40px;">🔐</div>
            <h1>Login Notification</h1>
        </div>

        <div class="content">
            <p class="message">Hi {{ $user->name }},</p>

            <p class="message">A new login to your account was detected.</p>

            <div class="info-box">
                <div class="info-row">
                    <span class="info-label">Time:</span> {{ $loginTime }}
                </div>
                <div class="info-row">
                    <span class="info-label">IP Address:</span> {{ $ipAddress }}
                </div>
                @if($userAgent)
                <div class="info-row">
                    <span class="info-label">Device:</span> {{ $userAgent }}
                </div>
                @endif
            </div>

            <p class="message">
                If this wasn't you, please change your password immediately.
            </p>

            <div style="text-align: center; margin: 20px 0;">
                <a href="{{ url(route('password.request')) }}" class="button">
                    Change Password
                </a>
            </div>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Banana Catcher</p>
        </div>
    </div>
</body>
</html>
