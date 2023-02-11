<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('markers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('status', 10)->default('active');
            $table->text('url');
            $table->string('domain')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable()->index();
            $table->text('notes')->nullable();
            $table->smallInteger('priority')->default(9999);
            $table->softDeletes();
            $table->timestamps();

            $table->index(['user_id', 'status'], 'user_status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('markers');
    }
};
