<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('city');
            $table->string('state');
            $table->string('ref');
            $table->string('url');
            $table->string('company_name');
            $table->text('description');
            $table->text('qualifications');
            $table->text('category');
            $table->string('status');
            $table->boolean('is_sample');
            $table->integer('parent_id');
            $table->integer('parent_company');

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
        Schema::drop('jobs');
    }
}
