<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('meeting_date');
            $table->string('meeting_name', 256);
            $table->string('meeting_company_name', 256);
            $table->string('meeting_company_url', 128);
            $table->string('meeting_app_name', 256);
            $table->tinyInteger('meeting_priority')->default(0);
            $table->text('meeting_description');
            $table->string('meeting_referral', 256);
            $table->string('meeting_address', 256);
            $table->softDeletes();
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
        Schema::dropIfExists('meetings');
    }
}
