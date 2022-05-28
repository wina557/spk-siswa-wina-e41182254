<div class="row">
	<div class="col-md-4">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="text-center">TAMBAH</h3>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('input/kriteria_tambah') ?>" method="POST">
					<div class="form-group">
						<label for="kode">Jenis</label>
						<select class="form-control" name="kode">
							<?php foreach ($jenis as $jen) : ?>
								<option value="<?= $jen->kode ?>"><?= $jen->nama ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="nama">Nama</label>
						<input type="text" name="nama" class="form-control">
						<small class="text-danger">
							<?= form_error('nama') ?>
						</small>
					</div>
					<div class="form-group">
						<label for="bobot">Bobot</label>
						<input type="text" name="bobot" class="form-control">
						<small class="text-danger">
							<?= form_error('bobot') ?>
						</small>
						<div class="form-group">
							<label for="sifat">sifat</label>
							<select class="form-control" name="sifat">
								<option>---</option>
								<option value="min">Min</option>
								<option value="max">Max</option>
							</select>
						</div>
					</div>
					<button type="submit" class="btn btn-info btn-block">Simpan</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="text-center">DAFTAR KRITERIA</h3>
			</div>
			<div class="panel-body">
				<?php if ($this->session->flashdata('message')) :
					echo $this->session->flashdata('message');
				endif; ?>
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>Kriteria</th>
							<th>Bobot</th>
							<th>Sifat</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						<?php foreach ($kriterias as $kriteria) : ?>
							<tr>
								<td><?= $no++ ?></td>
								<td>C<?= $kriteria->kd_kriteria ?></td>
								<td><?= $kriteria->nama ?></td>
								<td><?= $kriteria->bobot ?></td>
								<td><?= $kriteria->sifat ?></td>
								<td>
									<div class="btn-group">
										<a href="<?= base_url('input/kriteria_edit/' . $kriteria->kd_kriteria) ?>" class="btn btn-light btn-xs">Edit</a>
										<a onclick="return konfirmasi()" href="<?= base_url('input/kriteria_hapus/' . $kriteria->kd_kriteria) ?>" class="btn btn-danger btn-xs">Hapus</a>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>