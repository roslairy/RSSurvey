<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class Test1 extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'table1', function (Blueprint $table) {
			$table->increments ( 'id' );
			$table->string ( 'fucker' );
		} );
		Schema::create ( 'table2', function (Blueprint $table) {
			$table->increments ( 'id' );
			$table->string ( 'fucker' );
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ( 'table1');
		Schema::drop ( 'table2');
	}
}
