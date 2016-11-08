<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MasterResetTest extends TestCase
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

        $this->visit('/AdminOptions')
            ->see('Master Reset');

        //Check the database whether the default user has been registered
        $this->json('GET','/AdminOptions/masterReset/rrk10ict')
            ->seeInDatabase('users',['email' => 'notify.urscheduler@gmail.com']);
    }
}
