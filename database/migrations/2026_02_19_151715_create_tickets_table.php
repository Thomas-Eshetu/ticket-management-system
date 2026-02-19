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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('ticket_number')->unique();
            $table->string('department');
            $table->string('subject');
            $table->string('issue_type');
            $table->dateTime('issue_start_date');
            $table->string('no_of_impacted_users');
            $table->string('issue_description');
            $table->string('status');
            $table->string('priority')->nullable();
            $table->string('assigned_technician')->nullable();
            $table->dateTime('issue_resolved_at')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
