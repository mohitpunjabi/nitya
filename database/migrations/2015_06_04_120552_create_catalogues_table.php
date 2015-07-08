<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCataloguesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('catalogues', function(Blueprint $table)
		{
			$table->increments('id');
            $table->text('name');
            $table->text('access_key');
			$table->timestamps();
		});

        Schema::create('catalogue_product', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('catalogue_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->foreign('catalogue_id')
                ->references('id')
                ->on('catalogues')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::drop('catalogue_product');
		Schema::drop('catalogues');
	}

}
