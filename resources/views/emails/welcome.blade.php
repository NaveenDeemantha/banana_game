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
            <div class="greeting">Hello {{ $user->name }}! 👋</div>
            
            <p class="message">
                Thank you for joining <strong>Banana Catcher</strong> - the most exciting math game where you catch bananas while solving equations!
            </p>
            
            <p class="message">
                Your account has been successfully created, and you're now ready to start your mathematical adventure!
            </p>
            
            <div class="features">
                <h3 style="color: #F59E0B; margin-top: 0;">What you can do:</h3>
                
                <div class="feature">
                    <span class="feature-icon">⚡</span>
                    <span class="feature-text"><strong>Challenge Yourself</strong> - Choose from Easy, Medium, or Hard difficulty levels</span>
                </div>
                
                <div class="feature">
                    <span class="feature-icon">🏆</span>
                    <span class="feature-text"><strong>Compete</strong> - Climb the leaderboard and become the top player</span>
                </div>
                
                <div class="feature">
                    <span class="feature-icon">📊</span>
                    <span class="feature-text"><strong>Track Progress</strong> - View your stats and improve your skills</span>
                </div>
                
                <div class="feature">
                    <span class="feature-icon">🎯</span>
                    <span class="feature-text"><strong>Earn Rewards</strong> - Unlock achievements as you play</span>
                </div>
            </div>
            
            <div style="text-align: center; margin: 40px 0;">
                <a href="{{ config('app.url') }}/login" class="cta-button">
                    Start Playing Now! 🎮
                </a>
            </div>
            
            <p class="message" style="font-size: 14px; color: #666;">
                <strong>Quick Tips:</strong><br>
                • Practice with Easy mode first to get comfortable<br>
                • Race against the clock to maximize your score<br>
                • The faster you answer, the more points you earn!<br>
            </p>
        </div>
        
        <div class="footer">
            <p>Happy catching! 🍌</p>
            <p style="margin: 10px 0;">
                If you have any questions, feel free to reach out to our support team.
            </p>
            <div class="social-links">
                <a href="#">Help Center</a> | 
                <a href="#">Contact Us</a> | 
                <a href="#">Privacy Policy</a>
            </div>
            <p style="color: #999; font-size: 12px; margin-top: 20px;">
                © {{ date('Y') }} Banana Catcher. All rights reserved.<br>
                You're receiving this email because you created an account.
            </p>
        </div>
    </div>
</body>
</html>
