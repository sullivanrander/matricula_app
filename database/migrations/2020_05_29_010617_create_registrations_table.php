<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     * Enum status map ACTIVE Ativa, SUSPENDED Bloqueada, TERMINATED Cancelada, DROPOUT Desistente, COMPLETED Finalizada, PAUSED Trancada.
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->date('registration_date');
            $table->enum('status', ['ACTIVE', 'SUSPENDED', 'TERMINATED', 'DROPOUT', 'COMPLETED', 'PAUSED']);
            $table->foreignId('student_id')->constrained();
            $table->foreignId('course_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
