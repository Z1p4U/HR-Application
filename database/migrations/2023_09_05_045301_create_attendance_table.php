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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->year("attendance_year");
            $table->string("attendance_month");
            $table->string("attendance_day");
            $table->string("attendance_date");
            $table->string("checked_in_time")->nullable();
            $table->string("checked_out_time")->nullable();
            $table->string("attendance_count");
            $table->boolean("late_checkin")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
