<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

/**
 * Class UserOwnerSeeder
 */
 class UserOwnerSeeder extends Seeder
{
    /**
     * Run the Database Seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");

        User::truncate();

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@laravel.blog',
            'password' => Hash::make('q1w2e3r4'),
        ]);

        $user->createToken('app-token')->plainTextToken;

        DB::statement("SET foreign_key_checks=1");
    }
}
