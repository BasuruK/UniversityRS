<?php

use Illuminate\Database\Seeder;
use App\Allowed_User;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('priority')->insert([
            'priorityName' => 'Administrator',
            'priorityValue' => '100',
        ]);
        DB::table('priority')->insert([
            'priorityName' => 'Professor',
            'priorityValue' => '10',
        ]);
        DB::table('priority')->insert([
            'priorityName' => 'Doctor',
            'priorityValue' => '9',
        ]);
        DB::table('priority')->insert([
            'priorityName' => 'Senior Lecturer',
            'priorityValue' => '8',
        ]);
        DB::table('priority')->insert([
            'priorityName' => 'Assistant Lecturer',
            'priorityValue' => '7',
        ]);

        $AllowedUser = new Allowed_User();
        $AllowedUser->staff_id = "IT14020254";
        $AllowedUser->position = 1;
        $AllowedUser->save();

        $AllowedUser = new Allowed_User();
        $AllowedUser->staff_id = "IT14034978";
        $AllowedUser->position = 1;
        $AllowedUser->save();

        $AllowedUser = new Allowed_User();
        $AllowedUser->staff_id = "IT14030222";
        $AllowedUser->position = 1;
        $AllowedUser->save();

        $AllowedUser = new Allowed_User();
        $AllowedUser->staff_id = "IT14024764";
        $AllowedUser->position = 1;
        $AllowedUser->save();

        $User = new User();
        $User->staff_id = "IT14020254";
        $User->name = "Basuru Kusal";
        $User->email = "bestbasuru@live.com";
        $User->password = bcrypt("rrk10ict");
        $User->admin = 1;
        $User->save();

        $User = new User();
        $User->staff_id = "IT14034978";
        $User->name = "Sandamini Bandara";
        $User->email = "sheydenb31@gmail.com";
        $User->password = bcrypt("SandyB12");
        $User->admin = 1;
        $User->save();


        //Subject Seeds
        $subject = new Subject();
        $subject->subCode = "SC400";
        $subject->semester = "1";
        $subject->subName = "Software Components";
        $subject->year = "3";

        $subject = new Subject();
        $subject->subCode = "PDM300";
        $subject->semester = "1";
        $subject->subName = "Project Design and Management";
        $subject->year = "3";

        $subject = new Subject();
        $subject->subCode = "IT300";
        $subject->semester = "2";
        $subject->subName = "Operating Systems";
        $subject->year = "3";

        $subject = new Subject();
        $subject->subCode = "IT240";
        $subject->semester = "1";
        $subject->subName = "Computer Graphics and Multimedia";
        $subject->year = "2";

        $subject = new Subject();
        $subject->subCode = "IT200";
        $subject->semester = "2";
        $subject->subName = "Mathematics for Information Technology";
        $subject->year = "1";

        //Batch Seeds

        $batch = new Batch();
        $batch->batchNo = '1';
        $batch->year = '1';
        $batch->noOfStudents = '120';
        $batch->save();

        $batch = new Batch();
        $batch->batchNo = '2';
        $batch->year = '1';
        $batch->noOfStudents = '135';
        $batch->save();

        $batch = new Batch();
        $batch->batchNo = '3';
        $batch->year = '1';
        $batch->noOfStudents = '90';
        $batch->save();

        $batch = new Batch();
        $batch->batchNo = '1';
        $batch->year = '2';
        $batch->noOfStudents = '70';
        $batch->save();

        $batch = new Batch();
        $batch->batchNo = '2';
        $batch->year = '2';
        $batch->noOfStudents = '65';
        $batch->save();

        $batch = new Batch();
        $batch->batchNo = '1';
        $batch->year = '3';
        $batch->noOfStudents = '20';
        $batch->save();

        //end of Batch seeds
    }
}
