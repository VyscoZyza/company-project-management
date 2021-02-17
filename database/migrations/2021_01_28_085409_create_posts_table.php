<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->int('user_id', 10);
            $table->string('name', 100);
            $table->string('jabatan', 100);
            $table->string('supervisi', 100);
            $table->string('bagian', 100);
            $table->string('bidang', 100);
            $table->int('progress', 3);
            $table->string('status', 25);
            $table->date('target_selesai');
            $table->timestamp('tanggal_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
