<?php 

namespace App\Controllers;

class Pages extends BaseController
{
	public function index()
	{
		$uriSegment = new \CodeIgniter\HTTP\URI(env("APP.BASEURL")."/home");
		$data = [
			'title' => "Home | WebProgrammingUNPAS",
			'uriSegment' => $uriSegment
		];
		return view('pages/home', $data);
	}
	
	public function about()
	{
		$uriSegment = new \CodeIgniter\HTTP\URI(env("APP.BASEURL")."/pages/about");
		$data = [
			'title' => "About me | WebProgrammingUNPAS",
			'uriSegment' => $uriSegment
		];
		return view('pages/about', $data);
	}
	
	public function contact()
	{
		$uriSegment = new \CodeIgniter\HTTP\URI(env("APP.BASEURL")."/pages/contact");
		$data = [
			'title' => "Contact Us | WebProgrammingUNPAS",
			'uriSegment' => $uriSegment,
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
