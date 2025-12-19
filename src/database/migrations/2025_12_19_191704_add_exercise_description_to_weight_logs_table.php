<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('weight_logs', function (Blueprint $table) {
            $table->text('exercise_content')->nullable()->after('exercise_time');
        });
    }

    public function down()
    {
        Schema::table('weight_logs', function (Blueprint $table) {
            $table->dropColumn('exercise_content');
        });
    }
};
