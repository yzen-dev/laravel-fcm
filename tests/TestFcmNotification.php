<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\TestCase;


class TestFcmNotification extends TestCase
{
    /**
     * Корректный email
     */
    public function testChangeEmail()
    {
        Notification::fake();

        Auth::user()->notify(new TestNotify());

        Notification::assertSentTo(
            [$this->user],
            TestNotify::class
        );
    }
}