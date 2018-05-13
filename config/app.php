<?php
use Cake\Core\Configure;
use Cake\Utility\Hash;

$defaults = Configure::read('Users');

$values = $defaults + [
    // User model.
    'userModel' => 'Users.Users',
    // Enable users the ability to upload avatars
    'enableAvatarUploads' => true,
    // Enable the password-reset flow
    'enablePasswordReset' => true,
    // Finder conditions
    'conditions' => Hash::merge(Hash::get($defaults, 'conditions', []), [
        // Require that the user be "active"
        'active' => null,
        // Require that a user's email be authenticated
        'emailAuthenticated' => null,
    ]),
    // Make all users active immediately
    'setActiveOnCreation' => true,
    // Track last login timestamp in the database and session
    'trackLoginActivity' => true,
    // Track last activity timestamp in the database and session
    'trackLastActivity' => true,
    // Fields to use for authentication
    'fields' => Hash::merge(Hash::get($defaults, 'fields', []), [
        'username' => 'email',
        'password' => 'password',
    ]),
    // A route to the controller action that handles logins
    'loginAction' => Hash::merge(Hash::get($defaults, 'loginAction', []), [
        'plugin' => 'Users',
        'prefix' => false,
        'controller' => 'Users',
        'action' => 'login',
    ]),
    'loginRedirect' => Hash::merge(Hash::get($defaults, 'loginRedirect', []), [
    ]),
    'logoutRedirect' => Hash::merge(Hash::get($defaults, 'logoutRedirect', []), [
        'plugin' => 'Users',
        'prefix' => false,
        'controller' => 'Users',
        'action' => 'login',
    ]),
    // Social configuration
    'social' => Hash::merge(Hash::get($defaults, 'social', []), [
    ]),
];

return [
    'Users' => $values,
];
