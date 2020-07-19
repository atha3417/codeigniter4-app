<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;
use \Codeigniter\Database\Seeder;

class OrangSeeder extends Seeder
{
	public function run()
	{
		$faker = \Faker\Factory::create('id_ID');

		for ($i = 0; $i <= 1000; $i++) {
			$data = [
				'nama' => $faker->name,
				'alamat' => $faker->address,
				'created_at' => Time::createFromTimestamp($faker->unixTime()),
				'updated_at' => Time::now()
			];
			$this->db->table('orang')->insert($data);
		}
	}
}
