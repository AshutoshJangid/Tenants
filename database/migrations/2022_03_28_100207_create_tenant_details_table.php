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
        Schema::create('tenant_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('type')->nullable()->default(null);
            $table->string('joining_date')->nullable()->default(null);
            $table->string('rent_amt')->nullable()->default(null);
            $table->string('advance_amt')->nullable()->default(null);
            $table->string('electricity_amt')->nullable()->default(null);
            $table->string('agreement_date')->nullable()->default(null);
            $table->string('agreement_duration')->nullable()->default(null);
            $table->string('agreement_doc')->nullable()->default(null);
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
        Schema::dropIfExists('tenant_details');
    }
};
