<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->string('slug');
            $table->boolean('is_default')->default(false)->index();
            $table->smallInteger('order_by')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->index(['user_id', 'slug'], 'user_slug');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sections');
    }
};
