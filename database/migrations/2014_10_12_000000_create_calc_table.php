<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calc', function (Blueprint $table) {
            $table->increments('id');
            $table->double('opv')->nullable();
			$table->double('vocmc')->nullable();
			$table->double('ocmc')->nullable();
			$table->double('ipn')->nullable();
			$table->double('co')->nullable();
			$table->double('zp')->length(100)->nullable();
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
        Schema::dropIfExists('calc');
    }
}
