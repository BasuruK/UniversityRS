<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EntireSysTest extends TestCase
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

        $this->visit('/adminRequest')
            ->see('Request Management')
            ->click('Add Request')
            ->seePageIs('/adminRequest/newForm')
            ->type('2016-12-29-Sat','selectdate')
            ->select('8.30-10.30','selecttimeslot')
            ->select('IT14020254','selectstaff')
            ->select('Y1','selectyear')
            ->select('1','selectbatch')
            ->select('1','selectsub')
            ->select('B501','selectres')
            ->select('Approved','selectstatus')
            ->press('Submit')
            ->seePageIs('/adminRequest')
            ->see('Basuru Kusal')
            ->click('Delete')
            ->click('Sort By Batch')
            ->seePageIs('/adminRequest/BatchSort');

        $this->visit('/UserManagement')
            ->type('IT14020299', 'staff_id')
            ->select('1','inputPosition')
            ->press('Add User')
            ->seePageIs('/UserManagement');

        $this->visit('/resource/show')
            ->type('B307','hallNo')
            ->type('50','capacity')
            ->select('Lecture Hall','selectType')
            ->press('Submit')
            ->seePageIs('/resource/show');

        $this->visit('/subject')
            ->see('Subject Management')
            ->click('Add Subject')
            ->seePageIs('/subject/new')
            ->type('CNCO3000','subjectCode')
            ->type('ACC','subjectName')
            ->select('3','selectyear')
            ->select('2','selectsemester')
            ->press('Add')
            ->seePageIs('/subject')
            ->see('Subject was successful added!');

        $this->visit('/batch')
            ->see('Batch Management')
            ->click('Add Batch')
            ->seePageIs('/batch/new')
            ->type('1','batchNo')
            ->type('4','year')
            ->type('40','noStudents')
            ->press('Add Batch')
            ->seePageIs('/batch');

    }
}
