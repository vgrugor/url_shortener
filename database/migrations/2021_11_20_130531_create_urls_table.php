<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('short_key')->unique();
            $table->text('url');
            $table->string('domain');
            $table->timestamp('visited_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });

        DB::statement('ALTER TABLE urls MODIFY short_key VARCHAR(255) CHARACTER SET binary UNIQUE;');
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('urls');
    }
}
