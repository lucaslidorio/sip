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
        Schema::create('itens_enquete', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enquete_id');
            $table->string('nome', 45)->nullable();
            $table->integer('votos')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('enquete_id')
                  ->references('id')
                  ->on('enquetes')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intens_enquetes');
    }
};
