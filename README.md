# Laravel Chatkit

<p align="center">
<img src="https://d21buns5ku92am.cloudfront.net/67967/logo/retina-1530539712.png" alt="Pusher" width="150" height="150">
</p>

> A Laravel wrapper for [Pusher Chatkit](https://github.com/pusher/chatkit-server-php). Find out more about Chatkit [here](https://pusher.com/chatkit).

[![Build Status](https://img.shields.io/travis/shalvah/pusher-chatkit-laravel/master.svg?style=flat)](https://travis-ci.org/shalvah/pusher-chatkit-laravel)
[![Latest Version](https://img.shields.io/github/release/shalvah/pusher-chatkit-laravel.svg?style=flat)](https://github.com/shalvah/pusher-chatkit-laravel/releases)

*Note*: This package requires Laravel 5.5 or above 

## Installation

```bash
composer require shalvah/pusher-chatkit-laravel:dev-master
```

## Quick start
Publish the config file by running:

```bash
php artisan vendor:publish --provider="Chatkit\Laravel\ChatkitServiceProvider"
```

This will create a `config/chatkit.php` file in your app that you can modify to match your configuration.
Retrieve your Chatkit app details from your Chatkit app dashboard and add them in your `.env` file like so:

```bash
CHATKIT_INSTANCE_LOCATOR=your-instance-locator
CHATKIT_KEY=your-key
```

That's it. You can use Chatkit via the facade in your app:

```php
<?php
use Chatkit\Laravel\Facades\Chatkit;


public function startChatting()
{
    Chatkit::createUser(['id' => 'hc', 'name' => 'Hamilton Chapman']);
    Chatkit::createRoom(['creator_id' => 'hc', 'name' => 'Cat Lovers']);
    Chatkit::sendMessage(['sender_id' => 'hc', 'room_id' => 'r001', 'text' => 'Hi, everyone!' ]);
}
```
Alternatively, you may inject the `ChatkitManager` into your methods:

```php
<?php
use Chatkit\Laravel\ChatkitManager;

public function startChatting(ChatkitManager $chatkitManager)
{
    $chatkitManager->createUser(['id' => 'hc', 'name' => 'Hamilton Chapman']);
    $chatkitManager->createRoom(['creator_id' => 'hc', 'name' => 'Cat Lovers']);
    $chatkitManager->sendMessage([
        'sender_id' => 'hc', 
        'room_id' => 'r001', 
        'text' => 'Hi, everyone!'
    ]);
}
````

## Configuration

The `config/chatkit.php` file allows you to configure your Chatkit usage (for instance, to use multiple connections).

## Working with Multiple Connections
Supposing you have to work with multiple chat apps from the same server. You can do this easily by publishing the config file as explained above, then configuring your various connections in it as needed. You can then switch connections as needed using either the facade or Manager class:

```php
<?php

// use whatever connection is default -- by default, this is 'main'
Chatkit::createRoom(['creator_id' =>'admin', 'name' => 'Just Chat']);

// use the 'main' connection
Chatkit::connection('main')->createRoom(['creator_id' =>'admin', 'name' => 'Just Chat']);

// use the 'test' connection
Chatkit::connection('test')->createRoom('admin', ['name' => 'Just Chat']);

// use the 'secondary' connection
Chatkit::setDefaultConnection('secondary');
Chatkit::createRoom(['creator_id' =>'admin', 'name' => 'Just Chat']);
```

## Documentation
A complete listing of available methods is available at [the Chatkit PHP SDK docs](https://github.com/pusher/chatkit-server-php).

## License

MIT
