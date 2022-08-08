<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('forms')) {
            Schema::create('forms', function (Blueprint $table) {
                $table->id();
                $table->foreignId('store_id')->constrained();
                $table->foreignId('user_id')->constrained();
                $table->string('name');
                $table->string('type');
                $table->string('category');
                $table->json('data');
                $table->string('google_sheet_id')->nullable();
                $table->uuid()->nullable()->index();
                $table->jsonb('snapshot')->nullable();
                $table->timestamps();
                $table->softDeletes();

                // Indexes
                $table->index(['store_id', 'user_id']);
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
        Schema::dropIfExists('forms');
    }
}
