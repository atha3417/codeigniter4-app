<?php 

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{

	protected $komikModel;

	public function __construct()
	{
		$this->komikModel = new KomikModel();
	}

	public function index()
	{
		$data = [
			'title' => "Daftar Komik | WebProgrammingUNPAS",
			'komik' => $this->komikModel->getKomik()
		];
		return view('komik/index', $data);
	}

	public function detail($slug)
	{
		$komik = $this->komikModel->getKomik($slug);
		$data = [
			'title' => "Detail Komik | WebProgrammingUNPAS",
			'komik' => $komik
		];
		if (empty($data['komik'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik "'.$slug.'" tidak ditemukan!');
		}
		return view('komik/detail', $data);
	}

	public function create()
	{
		$data = [
			'title' => "Form Tambah Data Komik | WebProgrammingUNPAS",
			'error' => \Config\Services::validation()
		];
		return view('komik/create', $data);
	}

	public function save()
	{
		$validate = $this->validate([
			'judul' => [
				'rules' => 'required|is_unique[komik.judul]',
				'errors' => [
					'required' => '{field} komik harus diisi',
					'is_unique' => '{field} komik sudah ada'
				]
			],
			'penulis' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
			'penerbit' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
			'sampul' => [
				'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png,imgae/gif]',
				'errors' => [
					'max_size' => 'Ukuran gambar terlalu besar',
					'is_image' => 'File yang anda pilih bukan gambar',
					'mime_in' => 'File yang anda pilih bukan gambar'
				]
			]
		]);
		if (!$validate) {
			return redirect()->to('/komik/create')->withInput();
		}

		$fileSampul = $this->request->getFile('sampul');
		if ($fileSampul->getError == 4) {
			$namaSampul = 'default.jpg';
		} else {
			$namaSampul = $fileSampul->getRandomName();
			$fileSampul->move('img', $namaSampul);
		}


		$slug = url_title($this->request->getVar('judul'), '-', true);
		$this->komikModel->save([
			'judul' => $this->request->getVar('judul'),
			'slug' => $slug,
			'penulis' => $this->request->getVar('penulis'),
			'penerbit' => $this->request->getVar('penerbit'),
			'sampul' => $namaSampul
		]);
		session()->setFlashdata('pesan', 'Data berhasil ditambahkan!');
		return redirect()->to('/komik');
	}

	public function delete($id)
	{
		$komik = $this->komikModel->find($id);

		if ($komik['sampul'] != 'default.jpg') {
			unlink('img/'.$komik['sampul']);
		}

		$this->komikModel->delete($id);
		session()->setFlashdata('pesan', 'Data berhasil dihapus!');
		return redirect()->to('/komik');
	}

	public function edit($slug)
	{
		$data = [
			'title' => "Form Ubah Data Komik | WebProgrammingUNPAS",
			'error' => \Config\Services::validation(),
			'komik' => $this->komikModel->getKomik($slug)
		];
		return view('komik/edit', $data);
	}

	public function update($id)
	{
		$komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
		if ($komikLama['judul'] == $this->request->getVar('judul')) {
			$rule_judul = 'required';
		} else {
			$rule_judul = 'required|is_unique[komik.judul]';
		}
		$validate = $this->validate([
			'judul' => [
				'rules' => $rule_judul,
				'errors' => [
					'required' => '{field} komik harus diisi',
					'is_unique' => '{field} komik sudah ada'
				]
			],
			'penulis' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
			'penerbit' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
			'sampul' => [
				'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png,imgae/gif]',
				'errors' => [
					'max_size' => 'Ukuran gambar terlalu besar',
					'is_image' => 'File yang anda pilih bukan gambar',
					'mime_in' => 'File yang anda pilih bukan gambar'
				]
			]
		]);
		if (!$validate) {
			return redirect()->to('/komik/edit/'.$this->request->getVar('slug'))->withInput();
		}

		$fileSampul = $this->request->getFile('sampul');
		if ($fileSampul->getError == 4) {
			$namaSampul = $this->request->getVar('sampulLama');
		} else {
			$namaSampul = $fileSampul->getRandomName();
			$fileSampul->move('img', $namaSampul);
			unlink('img/'.$this->request->getVar('sampulLama'));
		}

		$slug = url_title($this->request->getVar('judul'), '-', true);
		$this->komikModel->save([
			'id' => $id,
			'judul' => $this->request->getVar('judul'),
			'slug' => $slug,
			'penulis' => $this->request->getVar('penulis'),
			'penerbit' => $this->request->getVar('penerbit'),
			'sampul' => $namaSampul
		]);
		session()->setFlashdata('pesan', 'Data berhasil diubah!');
		return redirect()->to('/komik');
	}
}




/*cara connect ke database tanpa model
$db = \Config\Database::connect();
$komik = $db->query("SELECT * FROM komik");
foreach ($komik->getResultArray() as $row) {
	dd($row);
}*/