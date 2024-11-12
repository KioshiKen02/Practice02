<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixUserIdForeignKeyInProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
        {
            Schema::table('products', function (Blueprint $table) {
                // Drop the incorrect foreign key constraint
                $table->dropForeign(['users_id']);
                
                // Rename the column (if needed)
                $table->renameColumn('user_id', 'users_id');
                
                // Re-add the correct foreign key constraint
                $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            });
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
