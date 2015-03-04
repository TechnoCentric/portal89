<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('ExpensesTableSeeder');
		$this->call('EtypesTableSeeder');
		$this->call('ProjectsTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('RevenuesTableSeeder');
		$this->call('Revenue_typesTableSeeder');
		$this->call('RtypesTableSeeder');
	}

}
