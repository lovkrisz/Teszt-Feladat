<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('tasks', function (Blueprint $table) {
			$table->id();
			$table->integer('project_id');
			$table->dateTime('start_time')->nullable();
			$table->dateTime('end_time')->nullable();
			$table->string('memo')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::dropIfExists('tasks');
	}
};
