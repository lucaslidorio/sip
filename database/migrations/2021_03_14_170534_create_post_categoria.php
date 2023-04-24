<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCategoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('post_id');            
            $table->timestamps();


            
            $table->foreign('category_id')
            ->references('id')
            ->on('categorias')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('post_id')
                    ->references('id')
                    ->on('posts')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_categoria');
    }
}
