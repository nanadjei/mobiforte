# Mobiforte SMS

This package provides a convenient way to send SMS from your Laravel application with mobiforte.com as a service provider.

## Installation

Download and install Composer (from `http://www.getcomposer.org/download`) if you do not have it already installed on your machine.

#### Method 1:

Require this package:

```bash
composer require nanadjei/mobiforte
```

#### Method 2:

Require this package:

```bash
{
    "require": {
       "nanadjei/mobiforte": "0.1.*"
    }
}
```

and run this command.

```bash
composer update
```

After updating Composer, add the ServiceProvider to the providers array in config/app.php

### Laravel <= 5.4

If you're using Laravel 5.5 and above, you can skip this step.

```bash
Nanadjei\Mobiforte\Mobiforte\MobiforteServiceProvider::class,
```

And the facade of the package to the \$aliases array.

```bash
'MobiforteSms' => Nanadjei\Mobiforte\Facades\MobiforteSms::class
```

### Configuration

Before you can start sending SMS you will need to set your api keys and default sender ID in your `.env` file. You can find your api key and api secret here `https://web.mobiforte.com/developer`

```
# In your root directory .env
# Note: Sender ID by default uses your app name (env('APP_NAME')). Sender Id must not exceed 11 characters.
MOBIFORTE_SMS_SENDER_ID=LaravelApp

MOBIFORTE_SMS_CLIENT_ID=YourClientId

MOBIFORTE_SMS_CLIENT_SECRET=YourClientSecrete
```

## Usage

Below is a basic usage guide for sending SMS and checking SMS balance of your Mobiforte account.

```php
# Basically sending sms uses api key set in .env file.
 MobiforteSms::send('02XXXXXXXX', "Hello from the other side.");

# Want to use a different api key?
 MobiforteSms::withFreshApiKeys("fresh_client_id", "fresh_client_secret")
   ->send("02XXXXXXXX", "Say hello from the other side.");

# To customise sender Id,
# NB: sender Id must not be more than 11 characters
MobiforteSms::from('CompanyName')->send('02XXXXXXXX', 'Say hello to a customer');
```

### Schedule When To Send Message

A date and time in Y-m-d H:i:s format. This DateTime should only be added when you want to schedule the message at a given time.

```php
$dateTime = \Carbon\Carbon::now()->addMinutes(30); // format: 2017-05-02 00:59:00
MobiforteSms::schedule('02XXXXXXXX', 'I have responded after 30 mins', $dateTime);
```

### Check SMS balance

This will return your remaining balance.

```php
MobiforteSms::balance();

# To check the balance using an api key different from the one set in the .env file
MobiforteSms::withFreshApiKeys("fresh_client_id", "fresh_client_secret")->balance();
```

## Contributing

Thank you for considering contributing to the package! To contribute, fork this repository, write some code and then submit a pull request to the develop branch 🤝

## License

[MIT](https://choosealicense.com/licenses/mit/)
