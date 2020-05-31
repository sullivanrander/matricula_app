<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'name' => 'Aluno 01',
            'cpf' => '11111111111',
            'born_date' => now()->floorYears(20),
            'email' => 'teste01@gmail.com',
            'telephone' => '062911111111',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'name' => 'Aluno 02',
            'cpf' => '22222222222',
            'born_date' => now()->floorYears(19),
            'email' => 'teste02@gmail.com',
            'telephone' => '062922222222',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'name' => 'Aluno 03',
            'cpf' => '33333333333',
            'born_date' => now()->floorYears(30),
            'email' => 'teste03@gmail.com',
            'telephone' => '062933333333',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'name' => 'Aluno 04',
            'cpf' => '44444444444',
            'born_date' => now()->floorYears(23),
            'email' => 'teste04@gmail.com',
            'telephone' => '062944444444',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'name' => 'Aluno 05',
            'cpf' => '55555555555',
            'born_date' => now()->floorYears(23),
            'email' => 'teste05@gmail.com',
            'telephone' => '062955555555',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
