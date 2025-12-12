<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Banana Catcher!</title>
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
            <div style="font-size: 40px;">🍌</div>
            <h1>Welcome to Banana Catcher!</h1>
        </div>

        <div class="content">
            <p class="message">Hi {{ $user->name }},</p>

            <p class="message">
                Thank you for registering! Your account has been successfully created.
            </p>

            <p class="message">
                You can now start playing the game and track your progress.
            </p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ url(route('login')) }}" class="button">
                    Start Playing
                </a>
            </div>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Banana Catcher</p>
        </div>
    </div>
</body>
</html>
