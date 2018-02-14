# Laravel Chatkit

![pusher](https://user-images.githubusercontent.com/499192/28176443-b96829f8-67f7-11e7-8cad-7322d296266e.jpg)

> A Laravel wrapper for [Pusher Chatkit](https://github.com/pusher/chatkit-server-php). Find out more about Chatkit [here](https://pusher.com/chatkit).

[![Build Status](https://img.shields.io/travis/shalvah/pusher-chatkit-laravel/master.svg?style=flat)](https://travis-ci.org/shalvah/pusher-chatkit-laravel)
[![Latest Version](https://img.shields.io/github/release/shalvah/pusher-chatkit-laravel.svg?style=flat)](https://github.com/shalvah/pusher-chatkit-laravel/releases)

*Note*: This package requires Laravel 5.5 or above 

## Installation

```bash
composer require shalvah/pusher-chatkit-laravel:dev-master
```

## Quick start
Retrieve your Chatkit app details from your Chatkit app dashboard and add them in your `.env` file like so:

```bash
CHATKIT_INSTANCE_LOCATOR=your-instance-locator
CHATKIT_KEY=your-key
```

That's it. You can use Chatkit via the facade in your app:

```php
<?php
use Chatkit\Laravel\Facades\Chatkit;


public function startChatting(string $introMessage)
{
    Chatkit::createUser('hc', 'Hamilton Chapman');
    Chatkit::createRoom('hc', ['name' => 'Cat Lovers']);
    Chatkit::sendMessage('hc', 'r001', $introMessage);
}
```
Alternatively, you may inject the `ChatkitManager` into your methods:

```php
<?php
use Chatkit\Laravel\ChatkitManager;

public function startChatting(ChatkitManager $chatkitManager, string $introMessage)
[
    $chatkitManager->createUser('hc', 'Hamilton Chapman');
    $chatkitManager->createRoom('hc', ['name' => 'Cat Lovers']);
    $chatkitManager->sendMessage('hc', 'r001', $introMessage);
}
````

## Configuration

The minimum configuration you'll need is to add your Chatkit app credentials to your `.env` file. If you'd like further customisation (for instance, to use multiple connections), you'll need to publish the config file:

```bash
php artisan vendor:publish --provider="Chatkit\Laravel\ChatkitServiceProvider"
```

This will create a `config/chatkit.php` file in your app that you can modify to match your configuration. 

## Working with Multiple Connections
Supposing you have to work with multiple chat apps from the same server. You can do this easily by publishing the config file as explained above, then configuring your various connections in it as needed. You can then switch connections as needed using either the facade or Manager class:

```php
<?php

// use whatever connection is default -- by default, this is 'main'
Chatkit::createRoom('admin', ['name' => 'Just Chat']);

// use the 'main' connection
Chatkit::connection('main')->createRoom('admin', ['name' => 'Just Chat']);

// use the 'test' connection
Chatkit::connection('test')->createRoom('admin', ['name' => 'Just Chat']);

// use the 'secondary' connection
Chatkit::setDefaultConnection('secondary');
Chatkit::createRoom('admin', ['name' => 'Just Chat']);
```

## Documentation
A complete listing of available methods is available at [the Chatkit PHP SDK docs](https://github.com/pusher/chatkit-server-php).

## License

MIT
