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
    Schema::create('import_histories', function (Blueprint $table) {
      $table->id();
      $table->string('period_name');
      $table->enum('type', ['payments', 'people', 'asset_discount', 'judicials'])->default('payments');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('import_histories');
  }
};
