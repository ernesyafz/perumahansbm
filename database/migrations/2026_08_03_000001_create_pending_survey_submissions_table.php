<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pending_survey_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('token', 64)->unique();
            $table->text('payload');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pending_survey_submissions');
    }
};
