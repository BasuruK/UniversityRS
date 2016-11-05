<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SemesterRequestFormTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);

        parent::AdminLogin();
        $this->visit('/AdminOptions/SemesterDeadlineChecked')
           ->seePageIs('/');

        $this->checkNotification();

        parent::AdminLogin();
        $this->visit('/AdminOptions/SemesterDeadlineUnchecked')
            ->seePageIs('/');

        $this->checkNotficationDontSee();
    }

    /**
     * Check whether the notification arrived at the users' side.
     */
    public function checkNotification()
    {
        parent::UserLogin();
        $this->visit("/")
            ->see('Semester Form now Available');
    }

    /**
     * Check whether the notification is still available after removing it.
     */
    public function checkNotficationDontSee()
    {
        parent::UserLogin();
        $this->visit("/")
            ->dontSee('Semester Form now Available');
    }
}
