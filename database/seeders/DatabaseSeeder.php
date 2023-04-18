<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::create([
            'name' => 'Admin',
            'email' => 'admin@drea.com',
            'dni' => '12345678',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'estado' => 'activo',
            'remember_token' => Str::random(10),
        ]);

        $this->call(PermissionSeeder::class);
        $this->call(PeriodSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
