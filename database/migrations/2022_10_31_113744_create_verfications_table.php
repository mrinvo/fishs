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
        Schema::create('verfications', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->references("id")->onUpdate("cascade")->onDelete("cascade");
            $table->string('otp_code');
            $table->timestamp('expire_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verfications');
    }
};
