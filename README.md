SisBIO Webapp
================================

SisBIO Webapp is a Yii 2 based application.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------
* PHP 5.4
* composer
* MySQL Server
* mod_rewrite enabled and configured as told at [Yii 2 Guide](http://www.yiiframework.com/doc-2.0/guide-start-installation.html)

INSTALLATION
------------

### Install from an Archive File

Extract the archive file downloaded from [github.com/schvarcz/SisBIO](https://github.com/schvarcz/SisBIO) to
a directory named `SisBIO` that is directly under the Web root.

You can then access the application through the following URL:

~~~
http://localhost/SisBIO/web/
~~~


### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this application template using the following command:

~~~
php composer.phar global require "fxp/composer-asset-plugin:1.0.0"
php composer.phar create-project --prefer-dist --stability=dev schvarcz/sisbio
~~~

Now you should be able to access the application through the following URL, assuming `SisBIO` is the directory
directly under the Web root.

~~~
http://localhost/SisBIO/web/
~~~


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=sisbio',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

Edit the file `config/console.php` with real data, for example:

```php
...

    'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        'useFileTransport' => false,
        'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.mandrillapp.com', // e.g. smtp.mandrillapp.com or smtp.gmail.com
            'username' => 'your@mail.com',
            'password' => 'password',
            'port' => '587', // Port 25 is a very common port too
            'encryption' => 'tls', // It is often used, check your provider or mail server specs
        ],
    ],
...
```

And add a job to send the invitation mails at your crontab:
```
*	*	*	*	*	/usr/bin/php /path/to/webserver/SisBIO/yii mail-sender-cron
```

**NOTE:** Yii won't create the database for you, this has to be done manually before you can access it.

Also check and edit the other files in the `config/` directory to customize your application.
