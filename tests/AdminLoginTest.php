<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminLoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);

        $this->visit('/login')
            ->see('Sign in')
            ->type('bestbasuru@live.com','email')
            ->type('rrk10ict','password')
            ->press('Sign in')
            ->seePageIs('/');
    }
}
