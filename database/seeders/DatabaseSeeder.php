<?php

namespace Database\Seeders;
use App\Models\Client;
use App\Models\Consultant;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Client::factory(10)->create();
        Consultant::factory(10)->create();
        
        $appointments = [];
        $appointments[0] = [
            'date' => '2022-11-28',
            'start_time' => "09:00",
            'end_time' =>"10:00",
            'client_id' => 2,
            'consultant_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $appointments[1] = [
            'date' => '2022-11-28',
            'start_time' => "10:00",
            'end_time' =>"11:00",
            'client_id' => 3,
            'consultant_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $appointments[2] = [
            'date' => '2022-11-28',
            'start_time' => "11:00",
            'end_time' =>"12:00",
            'client_id' => 1,
            'consultant_id' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ];

        DB::table('appointments')->insert($appointments);
    }
}
