<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_wellbeing_pillar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('wellbeing_pillar_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('order')->nullable(); // store selection order
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_wellbeing_pillar');
    }
};
