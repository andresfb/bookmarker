<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('markers', function (Blueprint $table) {
            $table->foreignId('section_id')
                ->nullable()
                ->after('user_id')
                ->constrained();
        });
    }

    public function down()
    {
        Schema::table('markers', function (Blueprint $table) {
            $table->dropColumn('section_id');
        });
    }
};