<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id('end_id');
            $table->string('end_tipo_logradouro', 50)->nullable();
            $table->string('end_logradouro', 200)->nullable();
            $table->integer('end_numero')->nullable();
            $table->string('end_bairro', 100)->nullable();
            $table->foreignId('cid_id')->nullable()->constrained('cidade', 'cid_id')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('enderecos');
    }
};
