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
        Schema::create('bill_details', function (Blueprint $table) {
            $table->id();
            $table->string('bill_id')->unique();//format monthYearUserId eg. 03225 :  march 2022, User ID 5 
            $table->integer('user_id');
            $table->integer('previous_unit');
            $table->integer('present_unit');
            $table->json('basic_charges');
            $table->json('other_charges');
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
        Schema::dropIfExists('bill_details');
    }
};
