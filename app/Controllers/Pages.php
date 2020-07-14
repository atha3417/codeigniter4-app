<?php 

namespace App\Controllers;

class Pages extends BaseController
{
	public function index()
	{
		$data = [
			'title' => "Home | WebProgrammingUNPAS"
		];
		return view('pages/home', $data);
	}

	public function about()
	{
		$data = [
			'title' => "About me | WebProgrammingUNPAS"
		];
		return view('pages/about', $data);
	}

	public function contact()
	{
		$data = [
			'title' => "Contact Us | WebProgrammingUNPAS",
			'alamat' => [
				[
					'tipe' => "rumah",
					'alamat' => "Jl. Abc No 123",
					'kota' => "Bandung"
				],
				[
					'tipe' => "kantor",
					'alamat' => "Jl. Cba No 321",
					'kota' => "Tangerang"
				]
			]
		];
		return view('pages/contact', $data);
	}

}
