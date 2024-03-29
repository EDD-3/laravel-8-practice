<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserToBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            //
            $table->foreignId('user_id')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_posts', function (Blueprint $table) {

            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            //
            // if (Schema::hasColumn('blog_posts', 'user_id')) {
                // The column exists in the table
                // Schema::disableForeignKeyConstraints();
                // $table->dropForeign(['user_id']);
                // $table->dropColumn('user_id');
                // Schema::enableForeignKeyConstraints();
            // }

        });
    }
}
