<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('templates')) {
            return;
        }
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('form_id')->constrained();
            $table->string('name');
            $table->string('type');
            $table->string('category');
            $table->json('data');
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['store_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('templates');
    }
}
