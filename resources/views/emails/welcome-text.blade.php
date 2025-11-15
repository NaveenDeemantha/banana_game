Welcome to Banana Catcher Educational Platform

Dear {{ $user->name }},

Thank you for registering your account with Banana Catcher. We are pleased to confirm that your account has been successfully created.

Your account is now active and you can begin using our platform immediately. We have prepared some helpful information to get you started.

ACCOUNT FEATURES:
• Difficulty Levels - Choose from Easy, Medium, or Hard settings
• Progress Tracking - Monitor your performance and scores over time
• Leaderboards - Compare your results with other users
• Skill Development - Practice mathematical problems in an engaging format

Access Your Account: {{ url(route('login')) }}

GETTING STARTED:
• Begin with Easy difficulty to familiarize yourself with the platform
• Complete problems quickly to earn higher scores
• Review your performance statistics regularly

CONTACT INFORMATION:
If you need assistance, please contact our support team at support@bananacatcher.com

Website: {{ url('/') }}
Privacy Policy: {{ url('/#/privacy') }}
Terms of Service: {{ url('/#/terms') }}

This email was sent to {{ $user->email }} because you created an account with Banana Catcher.

Banana Catcher, LLC
123 Math Street
Learning City, LC 12345

© {{ date('Y') }} Banana Catcher. All rights reserved.
