<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('tv_shows', function (Blueprint $table) {
        $table->string('type')->default('TV Show');
    });
}

public function down()
{
    Schema::table('tv_shows', function (Blueprint $table) {
        $table->dropColumn('type');
    });
}
};
