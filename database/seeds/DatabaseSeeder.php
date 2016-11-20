<?php

use Illuminate\Database\Seeder;
use App\Allowed_User;
use App\User;
use App\Subject;
use App\Batch;
use App\Resource;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Priority Seeds
        DB::table('priority')->insert([
            'priorityName' => 'Administrator',
            'priorityValue' => '100',
        ]);
        DB::table('priority')->insert([
            'priorityName' => 'Dean',
            'priorityValue' => '10',
        ]);
        DB::table('priority')->insert([
            'priorityName' => 'Professor',
            'priorityValue' => '9',
        ]);
        DB::table('priority')->insert([
            'priorityName' => 'Doctor',
            'priorityValue' => '8',
        ]);
        DB::table('priority')->insert([
            'priorityName' => 'Senior Lecturer',
            'priorityValue' => '7',
        ]);
        DB::table('priority')->insert([
            'priorityName' => 'Assistant Lecturer',
            'priorityValue' => '6',
        ]);

        //Allowed User Seeds
        $AllowedUser = new Allowed_User();
        $AllowedUser->staff_id = "IT14000000";
        $AllowedUser->position = 1;
        $AllowedUser->save();


        //Registered User seeds
        $User = new User();
        $User->staff_id = "IT14000000";
        $User->name = "Administrator";
        $User->email = "notify.urscheduler@gmail.com";
        $User->password = bcrypt("123456789");
        $User->admin = 1;
        $User->save();


        // Time Seeds
        
        DB::table('timeFormatTable')->insert([
            'time' => '8.30 - 9.30',
            'time24Format' => '8.30 - 9.30',
        ]);

        DB::table('timeFormatTable')->insert([
            'time' => '9.30 - 10.30',
            'time24Format' => '9.30 - 10.30',
        ]);

        DB::table('timeFormatTable')->insert([
            'time' => '10.30 - 11.30',
            'time24Format' => '10.30 - 11.30',
        ]);

        DB::table('timeFormatTable')->insert([
            'time' => '11.30 - 12.30',
            'time24Format' => '11.30 - 12.30',
        ]);

        DB::table('timeFormatTable')->insert([
            'time' => '12.30 - 1.30',
            'time24Format' => '12.30 - 13.30',
        ]);

        DB::table('timeFormatTable')->insert([
            'time' => '1.30 - 2.30',
            'time24Format' => '13.30 - 14.30',
        ]);

        DB::table('timeFormatTable')->insert([
            'time' => '2.30 - 3.30',
            'time24Format' => '14.30 - 15.30',
        ]);

        DB::table('timeFormatTable')->insert([
            'time' => '3.30 - 4.30',
            'time24Format' => '15.30 - 16.30',
        ]);
        
        DB::table('timeFormatTable')->insert([
            'time' => '4.30 - 5.30',
            'time24Format' => '16.30 - 17.30',
        ]);

        DB::table('timeFormatTable')->insert([
            'time' => '5.30 - 6.30',
            'time24Format' => '17.30 - 18.30',
        ]);

        DB::table('timeFormatTable')->insert([
            'time' => '6.30 - 7.30',
            'time24Format' => '18.30 - 19.30',
        ]);

        DB::table('timeFormatTable')->insert([
            'time' => '7.30 - 8.30',
            'time24Format' => '19.30 - 20.30',
        ]);


    }
}
