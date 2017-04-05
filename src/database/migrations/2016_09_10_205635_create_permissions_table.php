<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->integer('ability_id');
            $table->integer('permissionable_id');
            $table->string('permissionable_type');
            $table->timestamps();
			$table->softDeletes();
        });

//		Schema::create('abilityables', function (Blueprint $table) {
//			$table->integer('ability_id');
//			$table->integer('abilityable_id');
//			$table->string('abilityable_type');
//			$table->timestamps();
//		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
		Schema::dropIfExists('abilityables');
    }
}
