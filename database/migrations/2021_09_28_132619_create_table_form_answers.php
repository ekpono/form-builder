<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFormAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_answers', function (Blueprint $table) {
            $table->uuid()->unique()->index();
            $table->foreignUuid('form_uuid')->references('uuid')->on('forms');
            $table->foreignUuid('order_uuid')->references('uuid')->on('orders');
            $table->jsonb('answers');
            $table->jsonb('params')->nullable();
            $table->jsonb('order_items')->nullable();
            $table->timestamps();
            $table->dateTime('finished_at')->nullable();
            $table->primary(['form_uuid', 'order_uuid']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_answers');
    }
}
