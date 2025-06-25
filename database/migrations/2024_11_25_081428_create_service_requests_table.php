<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->string('service_type');
            $table->string('name');
            $table->string('phone_number');
            $table->string('email');
            $table->string('link_article')->nullable();
            $table->string('file_path')->nullable();
            $table->text('note')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
        });
    }    

    public function down()
    {
        Schema::dropIfExists('service_requests');
    }
}
