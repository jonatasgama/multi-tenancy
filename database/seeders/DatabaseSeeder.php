<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        if(tenant()){

            \App\Models\User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

        }else{

            $tenant = Tenant::query()->create([
                'id' => 'monica',
                'name' => 'Monica',
                'logo' => 'https://fakeimg.pl/170x170',
                'color' => 'blue',
                'from' => 'monica@email.com'
            ]);
            $tenant->domains()->create(['domain' => 'monica.localhost']);

            $tenant = Tenant::query()->create([
                'id' => 'jonatas',
                'name' => 'Jonatas',
                'logo' => 'https://fakeimg.pl/170x170/7a3838/909090',
                'color' => 'gray',
                'from' => 'jonatas@email.com'
            ]);
            $tenant->domains()->create(['domain' => 'jonatas.localhost']);
        }

    }
}
