<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'uid' => '1000000000',
                'email' => 'Admin@mail.com',
                'level' => '00',
                'jabatan' => 'Admin',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Vice President',
                'uid' => '1000000001',
                'email' => 'vp@mail.com',
                'level' => '01',
                'jabatan' => 'Vp',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Kepala Bagian',
                'uid' => '1000000002',
                'email' => 'kabag@mail.com',
                'level' => '02',
                'jabatan' => 'Kabag',
                'bagian' => 'IT',
                'bidang' => 'Operasional',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Supervisor',
                'uid' => '1000000003',
                'email' => 'spv@mail.com',
                'level' => '03',
                'jabatan' => 'Supervisor',
                'supervisi' => 'Software',
                'bagian' => 'IT',
                'bidang' => 'Operasional',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Staff',
                'uid' => '1000000004',
                'email' => 'staff@mail.com',
                'level' => '04',
                'jabatan' => 'Staff',
                'supervisi' => 'Software',
                'bagian' => 'IT',
                'bidang' => 'Operasional',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Staff2',
                'uid' => '1000000005',
                'email' => 'staff2@mail.com',
                'level' => '04',
                'jabatan' => 'Staff',
                'supervisi' => 'Software',
                'bagian' => 'IT',
                'bidang' => 'Operasional',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Staff3',
                'uid' => '1000000006',
                'email' => 'staff3@mail.com',
                'level' => '04',
                'jabatan' => 'Staff',
                'supervisi' => 'Software',
                'bagian' => 'IT',
                'bidang' => 'Operasional',
                'password' => bcrypt('123456'),
            ],
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
