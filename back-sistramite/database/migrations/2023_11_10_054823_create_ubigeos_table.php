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
        Schema::create('ubigeos', function (Blueprint $table) {
            $table->id();
            $table->char('codigo', 6)->unique();
            $table->enum('tipo', ['departamento', 'provincia', 'distrito']);
            $table->char('cod_dep', 2);
            $table->char('cod_prov', 2);
            $table->char('cod_dist', 2);
            $table->string('nombre', 191);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubigeos');
    }
};
