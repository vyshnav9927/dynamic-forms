# Setup Instructions

## Prerequisites
- PHP 8.1 or higher
- Composer
- Database (MySQL/PostgreSQL)

## Installation Steps

### 1. Install Dependencies
```bash
composer install
```

### 2. Environment Configuration
Configure your database settings in the `.env` file and ensure the cache store is set to Redis:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

# For queue, you can use either redis or database as the driver
QUEUE_CONNECTION=redis
# OR
# QUEUE_CONNECTION=database
```

### 3. Email Configuration with Mailtrap
For testing email functionality, this application uses Mailtrap service. Follow these steps:

1. **Create Mailtrap Account**: If you don't already have one, create a free account at [mailtrap.io](https://mailtrap.io)

2. **Get Your Credentials**: 
   - Log into your Mailtrap account
   - Navigate to Email Testing → Inboxes
   - Select your inbox and click on "SMTP Settings"
   - Copy the credentials from the integration settings

3. **Configure Email Settings**: Add the following email configuration to your `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
```

**Note**: Replace `your_mailtrap_username` and `your_mailtrap_password` with the actual credentials from your Mailtrap inbox settings.

### 4. Database Setup
Run the migrations and seed the database:
```bash
php artisan migrate --seed
```

### 5. Start the Application
Launch the Laravel development server:
```bash
php artisan serve
```

### 6. Queue Worker
Start the queue worker to listen for queued jobs:
```bash
php artisan queue:work
```

## Important Notes
- Keep the queue worker running in a separate terminal to process background jobs
- Check your Mailtrap inbox to view emails sent by the application during testing