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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->string("user_name");
            $table->string("leave_type");
            $table->longText("reason");
            $table->json("date");
            $table->boolean("half_day")->default(false);
            $table->float("requested_days");
            $table->float("annual_leave_left");
            $table->float("casual_leave_left");
            $table->float("probation_leave_left");
            $table->float("unpaid_leave_left");
            $table->string("status")->default("pending");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
