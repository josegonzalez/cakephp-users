# Users plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require josegonzalez/cakephp-users
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
