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
        Schema::table('applicants', function (Blueprint $table) {
            //
            $table->string("full_name")->after("job_id");

            $table->renameColumn("contact_phon", "contact_phone");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            //
            $table->dropColumn("full_name");
            $table->renameColumn("contact_phone", "contact_phon");
        });
    }
};
