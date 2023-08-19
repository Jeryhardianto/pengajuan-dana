<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user1 = \App\Models\User::factory()->create([
            'name' => 'Depertemen A',
            'email' => 'depa@test.com',
            'dept_id' => '2',
        ]);
        
        $user2 = \App\Models\User::factory()->create([
            'name' => 'Depertemen Finance',
            'email' => 'finance@test.com',
            'dept_id' => '1',
        ]);
        
        $user3 = \App\Models\User::factory()->create([
            'name' => 'Pimpinan',
            'email' => 'pimpinan@test.com',
            'dept_id' => '3',
        ]);

        $role = Role::create(['name' => 'user']);
        $user1->assignRole($role);

        $role = Role::create(['name' => 'finance']);
        $user2->assignRole($role);   
        
        $role = Role::create(['name' => 'pimpinan']);
        $user3->assignRole($role);

        $data = [
            ['id' => 1, 'nama_dept' => 'Departemen Finance'],
            ['id' => 2, 'nama_dept' => 'Departemen'],
            ['id' => 3, 'nama_dept' => 'Pimpinan'],
            // Tambahkan data departemen lainnya di sini
        ];

        DB::table('depertemens')->insert($data);



    }
}
