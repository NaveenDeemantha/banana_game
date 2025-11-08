# Email Configuration Guide for Banana Catcher

This guide will help you set up email notifications using Brevo (formerly Sendinblue) SMTP.

## Quick Setup

1. Copy the following configuration to your `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=your-brevo-email@example.com
MAIL_PASSWORD=your-brevo-smtp-password-here
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@bananacatcher.com
MAIL_FROM_NAME="Banana Catcher"
```

**Note:** Replace `your-brevo-email@example.com` and `your-brevo-smtp-password-here` with your actual Brevo credentials.

2. Clear configuration cache:
```bash
php artisan config:clear
php artisan cache:clear
```

3. Test email configuration:
```bash
php artisan tinker
```
Then run:
```php
Mail::raw('Test email from Banana Catcher!', function ($message) {
    $message->to('your-email@example.com')
            ->subject('Test Email');
});
```

## Email Features Implemented

### 1. Welcome Email (On Registration)
- **Trigger**: Automatically sent when a user registers
- **Template**: `resources/views/emails/welcome.blade.php`
- **Mailable**: `App\Mail\WelcomeEmail`
- **Listener**: `App\Listeners\SendWelcomeEmail`

**Features:**
- Personalized greeting with user's name
- Overview of game features
- Call-to-action button to start playing
- Quick tips for new players
- Beautiful, responsive HTML design

### 2. Login Notification Email (On Login)
- **Trigger**: Automatically sent when a user logs in
- **Template**: `resources/views/emails/login-notification.blade.php`
- **Mailable**: `App\Mail\LoginNotificationEmail`
- **Controller**: Updated `AuthenticatedSessionController`

**Features:**
- Login timestamp
- IP address
- Device/browser information
- Security warning if unauthorized access
- Link to secure account
- Security tips

## File Structure

```
app/
├── Mail/
│   ├── WelcomeEmail.php              # Welcome email mailable
│   └── LoginNotificationEmail.php    # Login notification mailable
├── Listeners/
│   └── SendWelcomeEmail.php          # Listener for registration event
└── Providers/
    └── AppServiceProvider.php        # Event registration

resources/views/emails/
├── welcome.blade.php                 # Welcome email HTML template
└── login-notification.blade.php      # Login notification HTML template

app/Http/Controllers/Auth/
└── AuthenticatedSessionController.php # Updated with login email logic
```

## How It Works

### Registration Flow:
1. User registers via `/register`
2. `Registered` event is fired by Laravel
3. `SendWelcomeEmail` listener catches the event
4. Welcome email is sent to the user's email address
5. User receives beautiful welcome email with game info

### Login Flow:
1. User logs in via `/login`
2. `AuthenticatedSessionController::store()` is called
3. Login details are captured (time, IP, user agent)
4. Login notification email is sent
5. User receives security notification email

## Customization

### Change Email Templates

Edit the Blade templates:
- Welcome email: `resources/views/emails/welcome.blade.php`
- Login notification: `resources/views/emails/login-notification.blade.php`

### Change Email Content

Edit the Mailable classes:
- `app/Mail/WelcomeEmail.php`
- `app/Mail/LoginNotificationEmail.php`

### Change "From" Address

Update in `.env`:
```env
MAIL_FROM_ADDRESS=your-email@yourdomain.com
MAIL_FROM_NAME="Your App Name"
```

## Testing Emails

### Test Welcome Email
```bash
php artisan tinker
```
```php
$user = App\Models\User::first();
Mail::to($user->email)->send(new App\Mail\WelcomeEmail($user));
```

### Test Login Notification
```bash
php artisan tinker
```
```php
$user = App\Models\User::first();
Mail::to($user->email)->send(
    new App\Mail\LoginNotificationEmail(
        $user, 
        now()->format('F j, Y, g:i a'),
        '127.0.0.1',
        'Mozilla/5.0...'
    )
);
```

## Queue Configuration (Optional - For Production)

For better performance, queue emails instead of sending them synchronously:

1. Update `.env`:
```env
QUEUE_CONNECTION=database
```

2. Run migrations for queue tables:
```bash
php artisan queue:table
php artisan migrate
```

3. Update Mailable classes to implement `ShouldQueue`:
```php
class WelcomeEmail extends Mailable implements ShouldQueue
{
    use Queueable;
    // ...
}
```

4. Run queue worker:
```bash
php artisan queue:work
```

## Troubleshooting

### Emails not sending?

1. **Check configuration**:
```bash
php artisan config:clear
php artisan tinker
```
```php
config('mail.mailers.smtp');
```

2. **Check logs**:
```bash
tail -f storage/logs/laravel.log
```

3. **Test SMTP connection**:
- Verify credentials in Brevo dashboard
- Check if port 587 is not blocked by firewall
- Ensure TLS encryption is supported

### Common Issues:

**Issue**: "Connection refused"
**Solution**: Check if port 587 is open, try port 465 with SSL

**Issue**: "Authentication failed"
**Solution**: Verify MAIL_USERNAME and MAIL_PASSWORD in .env

**Issue**: "Email not received"
**Solution**: 
- Check spam folder
- Verify sender email in Brevo dashboard
- Check Brevo sending limits

## Brevo Dashboard

Monitor your emails at: https://app.brevo.com/

Features:
- View sent emails
- Check delivery status
- Monitor bounce rates
- View email analytics

## Security Best Practices

1. **Never commit .env file** to version control
2. **Use environment variables** for sensitive data
3. **Rotate API keys** regularly
4. **Monitor email logs** for suspicious activity
5. **Implement rate limiting** for email sending

## Email Limits (Brevo Free Plan)

- 300 emails per day
- Unlimited contacts
- Brevo branding in emails

For higher limits, upgrade your Brevo plan.

## Support

If you encounter issues:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Check Brevo dashboard for delivery status
3. Verify SMTP credentials
4. Test with `php artisan tinker`

---

**Created**: November 8, 2025
**Version**: 1.0.0
**Status**: ✅ Ready for Production
