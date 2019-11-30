# Users plugin for CakePHP

Provides user authentication and administration for your CRUD-enabled application.

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require josegonzalez/cakephp-users
```

## Usage

Load the plugin

```php
Plugin::load('Users', ['bootstrap' => true, 'routes' => true]);
```

Create the `users` table with a migration similar to the following:

```shell
bin/cake bake migration create_users verified:boolean active:boolean email:string:unique:U_email password avatar avatar_dir created modified
```

If enabling password resets, you will also need to load the `Muffin/Tokenize` plugin and run it's migrations:

```shell
bin/cake plugin load Muffin/Tokenize --routes

bin/cake migrations migrate --plugin Muffin/Tokenize
```

If enablign social authenticationn, you will also need to load the `ADmad/SocialAuth` pluginn and run it's migrations:

```shell
bin/cake plugin load ADmad/SocialAuth -b -r

bin/cake migrations migrate -p ADmad/SocialAuth
```

And add the `AuthTrait` to your `AppController`:


```php
namespace App\Controller;

use Cake\Controller\Controller;
use Users\Controller\AuthTrait;

class AppController extends Controller
{
    use AuthTrait;
    public function initialize()
    {
        $this->loadAuthComponent();
    }
}
```

## Configuration

```php
return [
    'Users' => [
        // Name of the table to use
        'userModel' => 'Users.Users',

        // Enable users the ability to upload avatars
        'enableAvatarUploads' => true,

        // Enable the password-reset flow
        'enablePasswordReset' => true,

        // Require that a user's email be authenticated
        'requireEmailAuthentication' => true,

        // Make all users active immediately
        'setActiveOnCreation' => true,

        // Fields to use for authentication
        'fields' => [
            'username' => 'email',
            'password' => 'password',
        ],

        // SocialAuth plugin configuration
        'social' => [
            'getUserCallback' => 'getUserFromSocialProfile',
            'serviceConfig' => [
                'provider' => [
                    'facebook' => [
                        'applicationId' => '<application id>',
                        'applicationSecret' => '<application secret>',
                        'scope' => [
                            'email'
                        ]
                    ],
                ],
            ],
        ],
    ],
];
```
