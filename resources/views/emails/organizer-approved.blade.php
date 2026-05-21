<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Organizer Request Approved</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 40px;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #a855f7, #eab308);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 40px;
        }
        h1 {
            color: white;
            font-size: 28px;
            margin-bottom: 10px;
        }
        .code-box {
            background: linear-gradient(135deg, #a855f7, #eab308);
            padding: 20px;
            border-radius: 16px;
            text-align: center;
            margin: 30px 0;
        }
        .code {
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 5px;
            color: white;
            font-family: monospace;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #a855f7, #eab308);
            color: white;
            padding: 12px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            color: #999;
            font-size: 12px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">🎉</div>
            <h1>Congratulations, {{ $name }}! 🎊</h1>
            <p style="color: #ccc;">Your organizer request has been approved!</p>
        </div>
        
        <p style="color: white;">We're excited to have you as an official organizer on <strong>EventHub</strong>.</p>
        
        <div class="code-box">
            <p style="color: rgba(255,255,255,0.9); margin-bottom: 10px;">Your Verification Code</p>
            <div class="code">{{ $code }}</div>
            <p style="color: rgba(255,255,255,0.8); font-size: 12px; margin-top: 10px;">Valid for 24 hours</p>
        </div>
        
        <p style="color: white;">Please use this code during registration with email:</p>
        <p style="background: rgba(255,255,255,0.1); padding: 10px; border-radius: 8px; text-align: center; color: #eab308;">
            {{ $email }}
        </p>
        
        <div style="text-align: center;">
            <a href="{{ route('register') }}" class="button">Register as Organizer →</a>
        </div>
        
        <div class="footer">
            <p>This code will expire in 24 hours. If you didn't request this, please ignore this email.</p>
            <p>&copy; {{ date('Y') }} EventHub. All rights reserved.</p>
        </div>
    </div>
</body>
</html>