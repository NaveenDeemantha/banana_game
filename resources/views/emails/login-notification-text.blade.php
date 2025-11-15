Account Access Notification - Banana Catcher

Dear {{ $user->name }},

We are writing to inform you of a recent login to your Banana Catcher account.

LOGIN INFORMATION:
Time: {{ $loginTime }}
IP Address: {{ $ipAddress }}
@if($userAgent)
Device/Browser: {{ $userAgent }}
@endif
Account: {{ $user->email }}

ACCOUNT SECURITY INFORMATION:
If this login was authorized by you, no further action is required. Your account remains secure.

If this login was not authorized by you, we recommend that you change your password immediately to secure your account.

Change Password: {{ url(route('password.request')) }}

ACCOUNT SECURITY BEST PRACTICES:
• Use a strong, unique password for your account
• Do not share your login credentials with others
• Log out from public or shared computers after use
• Change your password periodically for enhanced security
• Enable additional security features when they become available

This notification helps protect your account security. If you have concerns, please contact our support team.

CONTACT INFORMATION:
Support Team: security@bananacatcher.com

Banana Catcher, LLC
123 Math Street
Learning City, LC 12345

© {{ date('Y') }} Banana Catcher. All rights reserved.
This is an automated security notification.
