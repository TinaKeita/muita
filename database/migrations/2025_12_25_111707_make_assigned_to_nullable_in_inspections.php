<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // migration failī
public function up()
{
    Schema::table('inspections', function (Blueprint $table) {
        $table->string('assigned_to')->nullable()->change();
    });
}

public function down()
{
    Schema::table('inspections', function (Blueprint $table) {
        $table->string('assigned_to')->nullable(false)->change();
    });
}

};
