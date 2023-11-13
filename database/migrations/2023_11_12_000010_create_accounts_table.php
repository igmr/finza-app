<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('usr_id')->nullable()->default(null);
            $table->unsignedBigInteger('ban_id')->nullable()->default(null);
            $table->string('name',65)->unique('ukAccount');
            $table->string('file',150)->nullable()->default(null);
            $table->text('observation')->nullable()->default(null);
            $table->string('status',20)->nullable()->default('Activo');
            $table->timestamp('created_at')->nullable()->default(null);
            $table->timestamp('updated_at')->nullable()->default(null);
            $table->timestamp('deleted_at')->nullable()->default(null);
            $table->foreign('usr_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('ban_id')->references('id')->on('banks')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
