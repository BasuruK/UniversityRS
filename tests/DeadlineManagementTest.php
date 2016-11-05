<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Deadline;

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
        $this->deleteDeadline();
    }

    /**
     * Add a new Deadline
     *
     * @return void
     */
    public function addDeadline()
    {
        $this->visit('/AdminOptions')
            ->see('Assign')
            ->select('1','year')
            ->select('1','semester')
            ->type('01/07/2017', 'datepicker')
            ->press('Save and notify users')
            ->see('Deadline entry added successfully');
    }

    /**
     * Delete the previously added deadline
     *
     * @return void
     */
    public function deleteDeadline()
    {
        $deadline = Deadline::all()->last();
        $this->visit('AdminOptions/' . $deadline->id . '/DeadlineDelete')
            ->seePageIs('AdminOptions/');

    }
}
