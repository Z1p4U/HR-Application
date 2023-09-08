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
        Schema::create('monthly_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('user_name');
            $table->integer("annual_leave_left");
            $table->integer("casual_leave_left");
            $table->integer("probation_leave_left");
            $table->integer("unpaid_leave_left");
            $table->string('attendance_month');
            $table->integer("late_checkin_count")->default(0);
            $table->year('attendance_year');
            $table->integer('attendance_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_attendances');
    }
};
