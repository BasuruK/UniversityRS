<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClearSemesterTimetableTest extends TestCase
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

        $this->visit('/AdminOptions');

        $this->json('GET','/AdminOptions/truncateTimeTable')
            ->dontSeeInDatabase('timetable',['year' => '3 Curtin IT']);
    }
}
