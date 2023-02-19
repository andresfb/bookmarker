<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('searchable_routes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('route');
            $table->text('description')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('searchable_routes');
    }
};
