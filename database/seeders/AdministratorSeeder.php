<?php

namespace Database\Seeders;

use App\Models\Administrator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdministratorSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!Administrator::whereEmail(['admin@admin.com'])->exists()) {

            Administrator::create([
                'name' => 'SeoEra',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123456'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10)
            ])
            ->assignRole('Super Administrator');
        }
    }
}
