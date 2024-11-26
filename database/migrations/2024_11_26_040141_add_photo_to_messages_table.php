<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('messages', function (Blueprint $table) {
        $table->string('photo')->nullable()->after('content'); // Поле для хранения пути к фото
    });
}

public function down()
{
    Schema::table('messages', function (Blueprint $table) {
        $table->dropColumn('photo');
    });
}

};
