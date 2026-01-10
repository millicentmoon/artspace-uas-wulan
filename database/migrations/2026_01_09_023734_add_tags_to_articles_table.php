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
    Schema::table('articles', function (Blueprint $table) {
        // Kolom untuk Gerakan Seni (misal: Seni Kuno)
        $table->string('movement')->nullable()->after('author');
        // Kolom untuk Bentuk Seni (misal: Lukisan)
        $table->string('type')->nullable()->after('movement');
    });
}

public function down(): void
{
    Schema::table('articles', function (Blueprint $table) {
        $table->dropColumn(['movement', 'type']);
    });
}
};
