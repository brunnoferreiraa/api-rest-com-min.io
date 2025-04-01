<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('unidade', function (Blueprint $table) {
            $table->id('unid_id');
            $table->string('unid_nome', 200);
            $table->foreignId('end_id')->nullable()->constrained('enderecos', 'end_id')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('unidade');
    }
};
