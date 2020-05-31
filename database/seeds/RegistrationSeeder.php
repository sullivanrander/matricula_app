<?php

use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('registrations')->insert([
            'registration_date' => now()->floorDays(30),
            'status' => 'ACTIVE',
            'student_id' => 1,
            'course_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('registrations')->insert([
            'registration_date' => now()->floorDays(30),
            'status' => 'PAUSED',
            'student_id' => 1,
            'course_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('registrations')->insert([
            'registration_date' => now()->floorDays(30),
            'status' => 'SUSPENDED',
            'student_id' => 2,
            'course_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('registrations')->insert([
            'registration_date' => now()->floorDays(30),
            'status' => 'DROPOUT',
            'student_id' => 3,
            'course_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('registrations')->insert([
            'registration_date' => now()->floorDays(30),
            'status' => 'TERMINATED',
            'student_id' => 4,
            'course_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('registrations')->insert([
            'registration_date' => now()->floorDays(30),
            'status' => 'TERMINATED',
            'student_id' => 5,
            'course_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
