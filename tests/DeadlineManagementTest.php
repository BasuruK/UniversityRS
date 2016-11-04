<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeadlineManagementTest extends TestCase
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

        $this->addDeadline();
    }

    public function addDeadline()
    {
        $this->visit('/AdminOptions')
            ->see('Assign')
            ->select('1','year')
            ->select('1','semester')
            ->type('01/07/2017', 'datepicker')
            ->press('Save and notify users');
    }
}
