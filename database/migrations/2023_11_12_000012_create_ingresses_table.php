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
        Schema::create('ingresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('usr_id')->nullable()->default(null);
            $table->unsignedBigInteger('cla_id')->nullable()->default(null);
            $table->unsignedBigInteger('sav_id')->nullable()->default(null);
            $table->unsignedBigInteger('deb_id')->nullable()->default(null);
            $table->unsignedBigInteger('acc_id')->nullable()->default(null);
            $table->string('concept',255)->nullable()->default(null);
            $table->string('description',255)->nullable()->default(null);
            $table->string('reference',255)->nullable()->default(null);
            $table->double('amount',4)->nullable()->default(0);
            $table->string('file',150)->nullable()->default(null);
            $table->text('observation')->nullable()->default(null);
            $table->string('status',20)->nullable()->default('Activo');
            $table->timestamp('created_at')->nullable()->default(null);
            $table->timestamp('updated_at')->nullable()->default(null);
            $table->timestamp('deleted_at')->nullable()->default(null);
            $table->foreign('usr_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('cta_id')->references('id')->on('categories')->nullOnDelete();
            $table->foreign('sav_id')->references('id')->on('savings')->nullOnDelete();
            $table->foreign('deb_id')->references('id')->on('debts')->nullOnDelete();
            $table->foreign('acc_id')->references('id')->on('accounts')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresses');
    }
};
