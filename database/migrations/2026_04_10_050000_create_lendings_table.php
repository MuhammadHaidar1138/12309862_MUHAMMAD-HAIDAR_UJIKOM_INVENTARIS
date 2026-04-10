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
        Schema::create('lendings', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('item_id')->constrained()->cascadeOnDelete();
            $table->integer('qty');
            $table->string('person_name');
            $table->string('staff_name');
            $table->string('receiver_name')->nullable();
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            $table->boolean('is_returned')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lendings');
    }
};
