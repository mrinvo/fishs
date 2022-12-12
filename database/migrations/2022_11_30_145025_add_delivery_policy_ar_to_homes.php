<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('homes', function (Blueprint $table) {
            $table->text('deliver_policy_en');
            $table->text('deliver_policy_ar');
            $table->text('return_policy_en');
            $table->text('return_policy_ar');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('homes', function (Blueprint $table) {
            //
            $table->text('deliver_policy_en');
            $table->text('deliver_policy_ar');
            $table->text('return_policy_en');
            $table->text('return_policy_ar');
        });
    }
};
