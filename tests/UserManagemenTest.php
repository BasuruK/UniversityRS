<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class UserManagemenTest extends TestCase
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

        $this->addUser();
        $this->editUser();
        $this->deleteUser();
    }

    public function addUser()
    {
        $this->visit('/UserManagement')
            ->type('IT14020299', 'staff_id')
            ->select('1','inputPosition')
            ->press('Add User')
            ->seePageIs('/UserManagement');
    }
     public function editUser()
     {
         $user = User::all()->last();
         $this->visit('AuthorizedUser/' . $user->id . '/edit')
             ->see('Edit User')
             ->type('IT13034978', 'staff_id')
             ->select('2','inputPosition')
             ->press('Edit')
             ->seePageIs('/UserManagement');
     }

     public function deleteUser()
     {
         $user = User::all()->last();
         $this->visit('AuthorizedUser/' . $user->id . '/delete')
             ->seePageIs('/UserManagement');
     }
}
