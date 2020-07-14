<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
	<div class="container">
		<div class="row">
			<div class="col">
				<a href="/komik/create" class="btn btn-primary mt-3">Tambah Data Komik</a>
				<h1 class="mt-2">Daftar Komik</h1>
				<?php if (session()->getFlashdata('pesan')): ?>
					<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
						<?= session()->getFlashdata('pesan'); ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif ?>
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Sampul</th>
								<th scope="col">Judul</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; foreach ($komik as $k): ?>
								<tr>
									<th scope="row"><?= $no++; ?></th>
									<td><img src="/img/<?= $k['sampul']; ?>" class="sampul img-thumbnail"></td>
									<td><?= $k['judul']; ?></td>
									<td>
										<a href="/komik/<?= $k['slug']; ?>" class="badge badge-pill badge-secondary">detail</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?= $this->endSection(); ?>