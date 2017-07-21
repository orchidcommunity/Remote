# Orchid Remote

Experimental Server for Orchid Integrator

## Installation

install package

```php
composer require orchid/remote
```

edit config/app.php service provider :
```php
 Orchid\Remote\Providers\RemoteServiceProvider::class
```

### Add services:
add remote config/services
```php
'integrator' => [
    'service1' => [
        'url' => 'http://localhost:8000',
        'key' => 'secret-key',
        'icon' => 'icon-energy',
        'name' => 'Demo'
    ],
],
```


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
