<?php

namespace LaravelFCM;

use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\ChannelManager;
use LaravelFCM\Channels\FirebaseChannel;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        Notification::resolved(function (ChannelManager $service) {
            $service->extend('fcm', function ($app) {
                return new FirebaseChannel();
            });
        });
    }
}