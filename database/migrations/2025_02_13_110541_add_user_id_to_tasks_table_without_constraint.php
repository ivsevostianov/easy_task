<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // First add the user_id column
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
        });

        // Assign all existing tasks to the first user
        if (DB::table('users')->count() > 0) {
            $firstUserId = DB::table('users')->first()->id;
            DB::table('tasks')->whereNull('user_id')->update(['user_id' => $firstUserId]);
        }

        // Add the foreign key constraint
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // Make the column required
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
