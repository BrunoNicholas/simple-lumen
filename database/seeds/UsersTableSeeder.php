<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user_super = new User();
        $user_super->name 		= 'Bruno Nicholas';
        $user_super->email 		= 'sbnibro256@gmail.com';
        $user_super->password 	= app('hash')->make('dollar');
        $user_super->occupation = 'Developer';
        $user_super->role 		= 'super-admin';
        $user_super->status 	= 'active';
        $user_super->save();

        $user_guest = new User();
        $user_guest->name 		= 'Guest User';
        $user_guest->email 		= 'guest@email.com';
        $user_guest->password 	= app('hash')->make('dollar');
        $user_guest->role 		= 'guest';
        $user_guest->occupation = 'Student';
        $user_guest->status 	= 'active';
        $user_guest->save();
    }
}
