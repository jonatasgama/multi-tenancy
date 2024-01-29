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

            $tenant = Tenant::query()->create(['id' => 'foo']);
            $tenant->domains()->create(['domain' => 'foo.localhost']);

            $tenant = Tenant::query()->create(['id' => 'bar']);
            $tenant->domains()->create(['domain' => 'bar.localhost']);
        }

    }
}
