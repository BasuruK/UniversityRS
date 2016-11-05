<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LecturerTimetableTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
        //login as a normal user.
        parent::UserLogin();

        $this->visit('/myTables')
            ->see('Timetable');

        $this->exportExcel();
        $this->exportPDF();
    }

    /**
     * Check Export Excel
     *
     * @return void
     */
    public function exportExcel()
    {
        $this->visit('/myTables')
            ->click('Export excel');
    }

    /**
     * Check Export PDH
     *
     * @return void
     */
    public function exportPDF()
    {
        $this->visit('/myTables')
            ->click('Export PDF');
    }
}
