<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
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
            padding: 5px 0;
            font-size: 14px;
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
            <div style="font-size: 40px;">👋</div>
            <h1>Logged Out</h1>
        </div>

        <div class="content">
            <p class="message">Hi {{ $user->name }},</p>

            <p class="message">
                You have been logged out of your account.
            </p>

            <div class="info-box">
                <div class="info-row"><strong>Time:</strong> {{ $logoutTime }}</div>
                <div class="info-row"><strong>IP Address:</strong> {{ $ipAddress }}</div>
                <div class="info-row"><strong>Device:</strong> {{ $userAgent }}</div>
            </div>

            <p class="message">
                If you didn't logout, please secure your account.
            </p>

            <div style="text-align: center; margin: 20px 0;">
                <a href="{{ url(route('login')) }}" class="button">
                    Log Back In
                </a>
            </div>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Banana Catcher</p>
        </div>
    </div>
</body>
</html>
