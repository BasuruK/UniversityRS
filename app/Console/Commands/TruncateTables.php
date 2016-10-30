<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class TruncateTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'truncate:Timetable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncates the Timetable';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::table('timetable')->truncate();
        $this->info('Truncated Timetable table successfully!');
    }
}
