<?php
use ADmad\SocialAuth\Middleware\SocialAuthMiddleware;
use Cake\Core\Configure;
use Cake\Event\EventManager;

/*
 * Read configuration file and inject configuration into various
 * CakePHP classes.
 *
 * By default there is only one configuration file. It is often a good
 * idea to create multiple configuration files, and separate the configuration
 * that changes from configuration that does not. This makes deployment simpler.
 */
try {
    Configure::load('Users.app', 'default', true);
} catch (\Exception $e) {
    exit($e->getMessage() . "\n");
}

EventManager::instance()->on('Server.buildMiddleware', function ($event, $middleware) {
    $config = Configure::read('Users');
    $socialConfig = $config['social'];
    if (empty($socialConfig['serviceConfig']['provider'])) {
        return;
    }

    if (empty($socialConfig['getUserCallback'])) {
        $socialConfig['getUserCallback'] = 'getUserFromSocialProfile';
    }

    $userModel = Configure::read('Users.userModel');
    if (empty($userModel)) {
        throw new LogicException('Configure value Users.userModel is empty');
    }
    $socialConfig['userModel'] = $userModel;

    $socialConfig['loginAction'] = Router::url($config['loginAction']);

    if (empty($config['fields']['username']) || empty($config['fields']['password'])) {
        throw new LogicException('Configure value Users.fields is invalid');
    }
    $socialConfig['fields'] = $config['fields'];

    $middleware->add(new SocialAuthMiddleware($socialConfig));
});
