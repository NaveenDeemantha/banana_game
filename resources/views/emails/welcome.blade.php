<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Banana Catcher!</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 25%, #FCD34D 50%, #FBBF24 75%, #F59E0B 100%);
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%);
            padding: 40px 20px;
            text-align: center;
        }
        .header .emoji {
            font-size: 80px;
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .header h1 {
            color: white;
            margin: 20px 0 10px;
            font-size: 32px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
        .content {
            padding: 40px 30px;
            color: #333;
        }
        .greeting {
            font-size: 24px;
            color: #F59E0B;
            margin-bottom: 20px;
        }
        .message {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .features {
            background: #FEF3C7;
            border-radius: 10px;
            padding: 20px;
            margin: 30px 0;
        }
        .feature {
            display: flex;
            align-items: center;
            margin: 15px 0;
        }
        .feature-icon {
            font-size: 30px;
            margin-right: 15px;
        }
        .feature-text {
            font-size: 14px;
            color: #666;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%);
            color: white;
            padding: 15px 40px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
            box-shadow: 0 4px 15px rgba(251, 191, 36, 0.4);
            transition: transform 0.3s;
        }
        .cta-button:hover {
            transform: translateY(-2px);
        }
        .footer {
            background: #F3F4F6;
            padding: 30px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .social-links {
            margin: 20px 0;
        }
        .social-links a {
            color: #F59E0B;
            text-decoration: none;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="emoji">🍌</div>
            <h1>Welcome to Banana Catcher!</h1>
        </div>

        <div class="content">
            <div class="greeting">Dear {{ $user->name }},</div>

            <p class="message">
                Thank you for registering your account with Banana Catcher. We are pleased to confirm that your account has been successfully created.
            </p>

            <p class="message">
                Your account is now active and you can begin using our platform immediately. We have prepared some helpful information to get you started.
            </p>

            <div class="features">
                <h3 style="color: #F59E0B; margin-top: 0;">Account Features:</h3>

                <div class="feature">
                    <span class="feature-icon">•</span>
                    <span class="feature-text"><strong>Difficulty Levels</strong> - Choose from Easy, Medium, or Hard settings</span>
                </div>

                <div class="feature">
                    <span class="feature-icon">•</span>
                    <span class="feature-text"><strong>Progress Tracking</strong> - Monitor your performance and scores over time</span>
                </div>

                <div class="feature">
                    <span class="feature-icon">•</span>
                    <span class="feature-text"><strong>Leaderboards</strong> - Compare your results with other users</span>
                </div>

                <div class="feature">
                    <span class="feature-icon">•</span>
                    <span class="feature-text"><strong>Skill Development</strong> - Practice mathematical problems in an engaging format</span>
                </div>
            </div>

            <div style="text-align: center; margin: 40px 0;">
                <a href="{{ url(route('login')) }}" class="cta-button">
                    Access Your Account
                </a>
            </div>

            <p class="message" style="font-size: 14px; color: #666;">
                <strong>Getting Started:</strong><br>
                • Begin with Easy difficulty to familiarize yourself with the platform<br>
                • Complete problems quickly to earn higher scores<br>
                • Review your performance statistics regularly<br>
            </p>
        </div>

        <div class="footer">
            <p>Welcome to Banana Catcher</p>
            <p style="margin: 10px 0;">
                If you need assistance, please contact our support team at support@bananacatcher.com
            </p>
            <div class="social-links">
                <a href="{{ url('/') }}">Website</a> |
                <a href="{{ url('/#/privacy') }}">Privacy Policy</a> |
                <a href="{{ url('/#/terms') }}">Terms of Service</a>
            </div>
            <p style="color: #999; font-size: 12px; margin-top: 20px;">
                This email was sent to {{ $user->email }} because you created an account with Banana Catcher.<br>
                Banana Catcher, LLC, 123 Math Street, Learning City, LC 12345<br>
                © {{ date('Y') }} Banana Catcher. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
