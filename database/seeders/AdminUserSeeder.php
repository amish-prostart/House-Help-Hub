<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            'first_name'        => 'Super',
            'last_name'         => 'Admin',
            'email'             => 'admin@househelphub.com',
            'password'          => Hash::make('123456789'),
            'role'              => 'Admin',
            'phone'             => '7878454512',
            'gender'            => 'Male',
            'address'           => 'Address',
            'city'              => 'surat',
            'state'             => 'Gujarat',
            'country'           => 'India',
            'status'            => 1,
            'is_active'         => 1,
            'email_verified_at' => Carbon::now(),
        ];

        $user = User::create($input);
    }
}
