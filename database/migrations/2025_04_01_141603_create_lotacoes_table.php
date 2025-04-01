<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lotacao', function (Blueprint $table) {
            $table->id('lot_id');
            $table->foreignId('unid_id')->constrained('unidade', 'unid_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('lotacao');
    }
};
