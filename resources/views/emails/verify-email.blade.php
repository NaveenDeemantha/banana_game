<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
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
        .otp-box {
            background: #FEF3C7;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            margin: 20px 0;
        }
        .otp-code {
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 8px;
            color: #F59E0B;
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
            <div style="font-size: 40px;">📧</div>
            <h1>Verify Your Email</h1>
        </div>

        <div class="content">
            <p class="message">Hi {{ $notifiable->name }},</p>

            <p class="message">
                Please verify your email address using the code below. This code will expire in 15 minutes.
            </p>

            <div class="otp-box">
                <div class="otp-code">{{ $otp }}</div>
                <p style="margin: 10px 0 0; font-size: 14px; color: #666;">Enter this code to verify your account</p>
            </div>

            <p class="message">
                If you didn't create an account, you can ignore this email.
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Banana Catcher</p>
        </div>
    </div>
</body>
</html>
