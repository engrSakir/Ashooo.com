<?php

use App\Balance;
use App\Rating;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =Faker\Factory::create();

        // 10 Admin
        for ($admin = 0; $admin < 10; $admin ++) {
            $user = new \App\User();
            $user->full_name = $faker->name;
            $user->user_name = $faker->unique()->userName;
            $user->phone = '0130473462'.$admin;
            $user->gender = 'male';
            $user->role = 'admin';
            $user->upazila_id = '1';
            $user->password = Hash::make('password');
            $user->save();

            //Rating
            $rating = new Rating();
            $rating->user_id  = $user->id;
            $rating->save();

            //Balance
            $rating = new Balance();
            $rating->user_id  = $user->id;
            $rating->save();
        }

        // 10 Controller
        for ($controller = 0; $controller < 10; $controller ++) {
            $user = new \App\User();
            $user->full_name = $faker->name;
            $user->user_name = $faker->unique()->userName;
            $user->phone = '0130473463'.$controller;
            $user->gender = 'male';
            $user->role = 'controller';
            $user->upazila_id = '1';
            $user->password = Hash::make('password');
            $user->save();

            //Rating
            $rating = new Rating();
            $rating->user_id  = $user->id;
            $rating->save();

            //Balance
            $rating = new Balance();
            $rating->user_id  = $user->id;
            $rating->save();

        }

        // 10 Worker
        for ($worker = 0; $worker < 10; $worker ++) {
            $user = new \App\User();
            $user->full_name = $faker->name;
            $user->user_name = $faker->unique()->userName;
            $user->phone = '0130473464'.$worker;
            $user->gender = 'male';
            $user->role = 'worker';
            $user->upazila_id = '1';
            $user->password = Hash::make('password');
            $user->save();

            //Rating
            $rating = new Rating();
            $rating->user_id  = $user->id;
            $rating->save();

            //Balance
            $rating = new Balance();
            $rating->user_id  = $user->id;
            $rating->save();

            for ($gigCount = 0; $gigCount < 5; $gigCount ++) {
                $gig = new \App\Gig();
                $gig->worker_id    = $user->id;
                $gig->service_id    = 1;
                $gig->title         = 'Gig title -'.$gigCount;
                $gig->description   = 'Gig description -'.$gigCount;
                $gig->tags          = 'Gig tag -'.$gigCount;
                $gig->price         = '250';
                $gig->day           = '10';
                $gig->save();
            }
        }

        // 10 Membership
        for ($membership = 0; $membership < 10; $membership ++) {
            $user = new \App\User();
            $user->full_name = $faker->name;
            $user->user_name = $faker->unique()->userName;
            $user->phone = '0130473465'.$membership;
            $user->gender = 'male';
            $user->role = 'membership';
            $user->upazila_id = '1';
            $user->password = Hash::make('password');
            $user->save();

            //Rating
            $rating = new Rating();
            $rating->user_id  = $user->id;
            $rating->save();

            //Balance
            $rating = new Balance();
            $rating->user_id  = $user->id;
            $rating->save();
        }

        // 10 Customer
        for ($customer = 0; $customer < 10; $customer ++) {
            $user = new \App\User();
            $user->full_name = $faker->name;
            $user->user_name = $faker->unique()->userName;
            $user->phone = '0130473466'.$customer;
            $user->gender = 'male';
            $user->role = 'customer';
            $user->upazila_id = '1';
            $user->password = Hash::make('password');
            $user->save();

            //Rating
            $rating = new Rating();
            $rating->user_id  = $user->id;
            $rating->save();

            //Balance
            $rating = new Balance();
            $rating->user_id  = $user->id;
            $rating->save();
        }
    }
}
