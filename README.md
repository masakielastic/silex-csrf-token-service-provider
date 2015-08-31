CsrfTokenServiceProvider for Silex
==================================

Installation
------------

Add the following code to `composer.json`.

```
{
    "repositories": [
    {
        "type": "package",
        "package": {
            "name": "masakielastic/silex-csrf-token-service-provider",
            "version": "0.1.0",
            "type": "package",
            "source": {
                "url": "https://github.com/masakielastic/silex-csrf-token-service-provider.git",
                "type": "git",
                "reference": "master"
            },
            "autoload": {
                "psr-4": { "Masakielastic\\Silex\\": "src/" }
            }
        }
    }
    ],
    "require": {
        "silex/silex": "~1.3",
        "symfony/security-csrf": "~2.7",
        "masakielastic/silex-csrf-token-service-provider": "*"
    }
}
```

Usage
-----

```php
use Silex\Application;
use Silex\Provider;
use Masakielastic\Silex\CsrfTokenServiceProvider;
use Symfony\Component\Security\Csrf\CsrfToken;

$app = new Application;
$app->register(new CsrfTokenServiceProvider());
$app['config.intention'] = 'intention';

$app->get('/', function (Application $app) {
    $token = $app['security.csrf.token_manager']->getToken($app['config.intention'])->getValue();
    $token2 = $app['security.csrf.token_generator']->generateToken();

    $csrfToken = new CsrfToken($app['config.intention'], $token);

    $valid = $app['security.csrf.token_manager']->isTokenValid($csrfToken);

    var_dump(
      $token,
      $token2,
      true === $valid
    );

    return '';
});
$app->run();
```

License
-------

MIT
