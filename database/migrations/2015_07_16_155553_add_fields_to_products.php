<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToProducts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->string('length')->nullable()->default(null);
            $table->string('neckline')->nullable()->default(null);
            $table->string('fabric')->nullable()->default(null);
            $table->string('rinse_care')->nullable()->default(null);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->dropColumn('length');
            $table->dropColumn('neckline');
            $table->dropColumn('fabric');
            $table->dropColumn('rinse_care');
		});
	}

}
