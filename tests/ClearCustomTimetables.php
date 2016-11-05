<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClearCustomTimetables extends TestCase
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

        $this->json('GET','/AdminOptions/customClearTables/2/1/true/true')
            ->dontSeeInDatabase('timetable',['year' => '1']);
    }
}
