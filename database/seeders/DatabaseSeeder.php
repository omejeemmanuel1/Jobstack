<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(5)->create();

        $user = User::factory()->create([
            'name' => 'Phalla Precious',
            'email' => 'phalla@yahoo.com'
        ]);

        Listing::factory(6)->create([
            'user_id' => $user->id
        ]);

        // Listing::create([
        //     'title' => 'Senior Software Engineer',
        //     'tags' => 'PHP, Laravel, Vue.js',
        //     'company' => 'Acme',
        //     'location' => 'Remote',
        //     'email' => 'emma@yahoo.com',
        //     'website' => 'http://omejeworld.netlify.com',
        //     'description' => 'Lorem ipsum dolydhhncnx xnnhh'
        // ]);

        // Listing::create([
        //     'title' => 'Senior Software Engineer',
        //     'tags' => 'PHP, Laravel, Vue.js',
        //     'company' => 'Acme',
        //     'location' => 'Remote',
        //     'email' => 'emma@yahoo.com',
        //     'website' => 'http://omejeworld.netlify.com',
        //     'description' => 'Lorem ipsum dolydhhncnx xnnhh'
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
