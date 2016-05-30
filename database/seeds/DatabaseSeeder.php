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

    }
}
