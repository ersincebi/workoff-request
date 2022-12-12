<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workoffs', function (Blueprint $table) {
            $table->foreignId('tc_no')
                    ->nullable()
                    ->references('tc_no')
                    ->on('employees')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->date('begin_date');
            $table->date('end_date');

            $table->index(['tc_no', 'begin_date', 'end_date']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workoffs');
    }
};
