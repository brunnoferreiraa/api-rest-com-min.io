<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('servidor_temporario', function (Blueprint $table) {
            $table->id('st_id');
            $table->foreignId('pes_id')->constrained('pessoa', 'pes_id')->onDelete('cascade');
            $table->foreignId('lot_id')->constrained('lotacao', 'lot_id')->onDelete('cascade');
            $table->date('st_data_inicio');
            $table->date('st_data_fim')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('servidor_temporario');
    }
};
