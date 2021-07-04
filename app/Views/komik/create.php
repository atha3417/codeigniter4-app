<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
	<div class="container">
		<div class="row">
			<div class="col-8">
				<h2 class="my-3">Form Tambah Data Komik</h2>
				<form action="/komik/save" method="post" enctype="multipart/form-data">
					<?= csrf_field(); ?>
					<div class="form-group row">
						<label for="judul" class="col-sm-2 col-form-label">Judul</label>
						<div class="col-sm-10">
							<input type="text" class="form-control <?= $error->hasError('judul') ? "is-invalid" : null; ?>" id="judul" name="judul" value="<?= old('judul'); ?>" autofocus autocomplete="off">
							<div class="invalid-feedback"><?= $error->getError('judul'); ?></div>
						</div>
					</div>
					<div class="form-group row">
						<label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
						<div class="col-sm-10">
							<input type="text" class="form-control <?= $error->hasError('penulis') ? "is-invalid" : null; ?>" id="penulis" name="penulis" value="<?= old('penulis'); ?>" autocomplete="off">
							<div class="invalid-feedback"><?= $error->getError('penulis'); ?></div>
						</div>
					</div>
					<div class="form-group row">
						<label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
						<div class="col-sm-10">
							<input type="text" class="form-control <?= $error->hasError('penerbit') ? "is-invalid" : null; ?>" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>" autocomplete="off">
							<div class="invalid-feedback"><?= $error->getError('penerbit'); ?></div>
						</div>
					</div>
					<div class="form-group row">
						<label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
						<div class="col-sm-2">
							<img src="/img/default.jpg" class="img-thumbnail img-preview">
						</div>
						<div class="col-sm-8">
							<div class="custom-file">
								<input type="file" class="custom-file-input form-control <?= $error->hasError('sampul') ? "is-invalid" : null; ?>" id="sampul" name="sampul" onchange="previewImg()">
								
								<div class="invalid-feedback"><?= $error->getError('sampul'); ?></div>
								<label class="custom-file-label" for="sampul">Pilih gambar</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-10 offset-2 d-flex justify-content-end">
							<button type="submit" class="btn btn-primary">Tambah Data</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
<?= $this->endSection(); ?>