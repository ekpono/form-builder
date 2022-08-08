<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('files')) {
            Schema::create('files', function (Blueprint $table) {
                $table->id();
                $table->string('path');
                $table->string('disk');
                $table->string('extension');
                $table->string('content_type');
                $table->string('catalog');
                $table->foreignId('store_id')->references('id')->on('stores');
                $table->foreignId('user_id')->references('id')->on('users');
                $table->timestamps();
                $table->index('path');
                $table->index(['catalog', 'store_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}