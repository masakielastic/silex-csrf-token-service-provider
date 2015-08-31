<?php

namespace Masakielastic\Silex;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\CsrfTokenManager;


class CsrfTokenServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        if (!isset($app['security.token_generator'])) {
            $app['security.csrf.token_generator'] = $app->share(function () {
                return new UriSafeTokenGenerator();
            });
        }

        if (!isset($app['security.csrf.token_manager'])) {
            $app['security.csrf.token_manager'] = $app->share(function () {
                return new CsrfTokenManager();
            });
        }
    }

    public function boot(Application $app)
    {
    }
}