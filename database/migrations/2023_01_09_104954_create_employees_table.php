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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('position_id')->constrained('positions');
            $table->string('name');
            $table->date('employment_at');
            $table->string('phone');
            $table->string('email');
            $table->float('salary');
            $table->string('photo')->nullable();
            $table->string('preview')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('admin_created_id');
            $table->unsignedBigInteger('admin_updated_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
