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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('assigned_by_id')->unsigned();
            $table->bigInteger('assigned_to_id')->unsigned();
            $table->string('title');
            $table->text('description');


            $table->foreign('assigned_by_id')->references('id')->on('users')
            ->onDelete("cascade");
            $table->foreign('assigned_to_id')->references('id')->on('users')
            ->onDelete("cascade");



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
        Schema::dropIfExists('tasks');
    }
};
