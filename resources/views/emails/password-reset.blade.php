<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
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
        .button {
            display: inline-block;
            background: #F59E0B;
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
            <div style="font-size: 40px;">🔑</div>
            <h1>Password Reset Request</h1>
        </div>

        <div class="content">
            <p class="message">Hi {{ $user->name }},</p>

            <p class="message">
                You requested to reset your password. Click the button below to create a new password.
                This link will expire in <strong>{{ $expiresIn }} minutes</strong>.
            </p>

            <div style="text-align: center; margin: 20px 0;">
                <a href="{{ $resetUrl }}" class="button">Reset Password</a>
            </div>

            <p class="message">
                If you didn't request this, you can safely ignore this email.
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Banana Catcher</p>
        </div>
    </div>
</body>
</html>
