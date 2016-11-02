<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class clientTest extends TestCase
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
            ->type('sheydenb31@gmail.com','email')
            ->type('SandyB12','password')
            ->press('Sign in')
            ->seePageIs('/');

        $this->visit('/myTables')
            ->see('User Timetables');

        $this->visit('/logout')
            ->see('/');
    }
}
