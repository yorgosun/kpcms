<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShuwensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shuwens', function (Blueprint $table) {
            $table->increments('id');
			$table->text('shu');
			$table->text('chao')->nullable();
			$table->integer('kepan_id')->unsigned();
			$table->integer('sequence')->default(0);
            $table->timestamps();
			$table->index('kepan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shuwens');
    }
}
