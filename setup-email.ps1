# PowerShell script to update .env with Brevo SMTP configuration

Write-Host "🍌 Banana Catcher - Email Configuration Setup" -ForegroundColor Yellow
Write-Host "=============================================" -ForegroundColor Yellow
Write-Host ""

$envFile = ".env"

if (-not (Test-Path $envFile)) {
    Write-Host "❌ Error: .env file not found!" -ForegroundColor Red
    Write-Host "Please copy .env.example to .env first:" -ForegroundColor Red
    Write-Host "cp .env.example .env" -ForegroundColor Cyan
    exit 1
}

Write-Host "📧 Configuring Brevo SMTP settings..." -ForegroundColor Green

# Read current .env content
$envContent = Get-Content $envFile

# Prompt for credentials
Write-Host "Please enter your Brevo SMTP credentials:" -ForegroundColor Cyan
$mailUsername = Read-Host "MAIL_USERNAME (your Brevo email)"
$mailPassword = Read-Host "MAIL_PASSWORD (your Brevo SMTP key)" -AsSecureString
$mailPasswordPlain = [Runtime.InteropServices.Marshal]::PtrToStringAuto([Runtime.InteropServices.Marshal]::SecureStringToBSTR($mailPassword))

# Update or add mail configuration
$mailConfigs = @{
    'MAIL_MAILER' = 'smtp'
    'MAIL_HOST' = 'smtp-relay.brevo.com'
    'MAIL_PORT' = '587'
    'MAIL_USERNAME' = $mailUsername
    'MAIL_PASSWORD' = $mailPasswordPlain
    'MAIL_ENCRYPTION' = 'tls'
    'MAIL_FROM_ADDRESS' = 'noreply@bananacatcher.com'
    'MAIL_FROM_NAME' = '"Banana Catcher"'
}

foreach ($key in $mailConfigs.Keys) {
    $value = $mailConfigs[$key]
    $pattern = "^$key=.*"
    
    if ($envContent -match $pattern) {
        # Update existing line
        $envContent = $envContent -replace $pattern, "$key=$value"
        Write-Host "✓ Updated $key" -ForegroundColor Green
    } else {
        # Add new line
        $envContent += "$key=$value"
        Write-Host "✓ Added $key" -ForegroundColor Green
    }
}

# Save updated content
$envContent | Set-Content $envFile

Write-Host ""
Write-Host "✅ Email configuration completed successfully!" -ForegroundColor Green
Write-Host ""
Write-Host "📋 Next steps:" -ForegroundColor Cyan
Write-Host "1. Clear configuration cache: php artisan config:clear" -ForegroundColor White
Write-Host "2. Test email: php artisan tinker" -ForegroundColor White
Write-Host ""
Write-Host "📖 Read EMAIL_SETUP_GUIDE.md for detailed instructions" -ForegroundColor Yellow
