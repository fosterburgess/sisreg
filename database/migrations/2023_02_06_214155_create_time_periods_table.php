<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('time_periods', function (Blueprint $table) {
            $table->id();
            $table->integer("org_id")->nullable();
            $table->date("start_date");
            $table->date("end_date")->nullable();
            $table->string("type")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_periods');
    }
};
