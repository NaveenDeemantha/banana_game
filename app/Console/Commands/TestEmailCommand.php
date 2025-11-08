<?php

namespace App\Console\Commands;

use App\Mail\WelcomeEmail;
use App\Mail\LoginNotificationEmail;
use App\Mail\LogoutNotificationEmail;
use App\Mail\PasswordChangedEmail;
use App\Notifications\CustomResetPasswordNotification;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class TestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test {type=welcome} {--email=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email sending. Types: welcome, login, logout, password-changed, password-reset. Usage: php artisan email:test welcome --email=test@example.com';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');
        $email = $this->option('email');

        // Get a user for testing
        if ($email) {
            $user = User::where('email', $email)->first();
            if (!$user) {
                $this->error("User with email {$email} not found!");
                return 1;
            }
        } else {
            $user = User::first();
            if (!$user) {
                $this->error('No users found in database! Please create a user first.');
                return 1;
            }
        }

        $this->info("🍌 Testing {$type} email to: {$user->email}");

        try {
            if ($type === 'welcome') {
                Mail::to($user->email)->send(new WelcomeEmail($user));
                $this->info('✅ Welcome email sent successfully!');
                
            } elseif ($type === 'login') {
                Mail::to($user->email)->send(
                    new LoginNotificationEmail(
                        $user,
                        now()->format('F j, Y, g:i a'),
                        '127.0.0.1',
                        'Test Browser - Mozilla/5.0'
                    )
                );
                $this->info('✅ Login notification email sent successfully!');
                
            } elseif ($type === 'logout') {
                Mail::to($user->email)->send(
                    new LogoutNotificationEmail(
                        $user,
                        now()->format('F j, Y, g:i a'),
                        '127.0.0.1',
                        'Test Browser - Mozilla/5.0'
                    )
                );
                $this->info('✅ Logout notification email sent successfully!');
                
            } elseif ($type === 'password-changed') {
                Mail::to($user->email)->send(
                    new PasswordChangedEmail(
                        $user,
                        now()->format('F j, Y, g:i a'),
                        '127.0.0.1',
                        'Test Browser - Mozilla/5.0'
                    )
                );
                $this->info('✅ Password changed email sent successfully!');
                
            } elseif ($type === 'password-reset') {
                // Generate a password reset token
                $token = Password::createToken($user);
                $user->notify(new CustomResetPasswordNotification($token));
                $this->info('✅ Password reset email sent successfully!');
                
            } else {
                $this->error('Invalid email type. Use: welcome, login, logout, password-changed, or password-reset');
                return 1;
            }

            $this->newLine();
            $this->info('📧 Check your inbox (and spam folder) at: ' . $user->email);

        } catch (\Exception $e) {
            $this->error('❌ Failed to send email!');
            $this->error('Error: ' . $e->getMessage());
            $this->newLine();
            $this->warn('💡 Troubleshooting tips:');
            $this->line('1. Check your .env file has correct SMTP settings');
            $this->line('2. Run: php artisan config:clear');
            $this->line('3. Verify Brevo credentials in .env');
            $this->line('4. Check storage/logs/laravel.log for details');
            return 1;
        }

        return 0;
    }
}
