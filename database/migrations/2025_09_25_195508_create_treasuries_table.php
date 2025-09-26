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
        Schema::create('treasuries', function (Blueprint $table) {
            $table->id();
            $table->string('description'); // Descripción del movimiento
            $table->enum('type', ['income', 'expense']); // Tipo de movimiento: ingreso o egreso
            $table->decimal('amount', 10, 2); // Monto del movimiento
            $table->string('category'); // Categoría del movimiento
            $table->date('transaction_date'); // Fecha de la transacción
            $table->string('reference')->nullable(); // Referencia o código de la transacción
            $table->string('status')->default('completed'); // Estado de la transacción
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Usuario que registró el movimiento
            $table->foreignId('lodge_id')->nullable()->constrained()->onDelete('set null'); // Logia asociada (opcional)
            $table->text('notes')->nullable(); // Notas adicionales
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treasuries');
    }
};
