<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('plan_id')->constrained('planes');
            $table->date('fecha_pago');
            $table->time('hora_pago')->default(DB::raw('CURRENT_TIME'));
            $table->decimal('valor_total', 10, 2)->default(0);
            $table->decimal('valor_pagado', 10, 2)->default(0);
            $table->decimal('cambio', 10, 2)->default(0);
            $table->boolean('estado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
