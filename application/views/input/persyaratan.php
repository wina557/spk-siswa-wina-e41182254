<div class="row">
	<div class="col-md-4">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="text-center">TAMBAH </h3>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('input/persyaratan_detail') ?>" method="post">
					<div class="form-group">
						<label for="nis">Siswa</label>
						<select class="form-control" name="nis" required>
							<option value="">Pilih Siswa</option>
							<?php foreach ($siswa as $sis) : ?>
								<option value="<?= $sis->nis ?>"><?= $sis->nis ?> | <?= $sis->nama ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="kode">Jenis Perhitungan</label>
						<select class="form-control" name="kode" id="jenis" required>
							<option value="">Pilih Jenis Perhitungan</option>
							<?php foreach ($jenis as $jen) : ?>
								<option value="<?= $jen->kode ?>"><?= $jen->nama ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<button type="submit" id="simpan" class="btn btn-info btn-block">Tampilkan</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="text-center">DAFTAR</h3>
			</div>
			<div class="panel-body">
				<?php if ($this->session->flashdata('message')) :
					echo $this->session->flashdata('message');
				endif; ?>
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>No</th>
							<th>NIS</th>
							<th>Nama</th>
							<th>Jenis Perhitungan</th>
							<th>Kriteria</th>
							<th>Nilai</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						<?php foreach ($persyaratans as $persyaratan) : ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $persyaratan->nis ?></td>
								<td><?= $persyaratan->nama_siswa ?></td>
								<td><?= $persyaratan->nama_jenis ?></td>
								<td><?= $persyaratan->nama_kriteria ?></td>
								<td><?= $persyaratan->nilai ?></td>
								<td>
									<div class="btn-group">
										<a href="javascript:edit('<?php echo $persyaratan->kd_nilai ?>')" class="btn btn-light btn-xs">Edit</a>
										<!-- <a href="<?= base_url('input/persyaratan_edit/' . $persyaratan->kd_nilai) ?>" class="btn btn-light btn-xs">Edit</a> -->
										<a onclick="return konfirmasi()" href="<?= base_url('input/persyaratan_hapus/' . $persyaratan->kd_nilai) ?>" class="btn btn-danger btn-xs">Hapus</a>
									</div>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?php echo site_url('input/update_persyaratan') ?>" method="POST">
				<div class="modal-header">
					<b class="modal-title">Edit Nilai</b>
					<button class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Jenis Perhitungan</label>
						<input type="text" class="form-control" name="jenis" readonly>
					</div>
					<div class="form-group">
						<label>NIS siswa</label>
						<input type="text" class="form-control" name="nis" readonly>
					</div>
					<div class="form-group">
						<label>Nama siswa</label>
						<input type="text" class="form-control" name="nama_siswa" readonly>
					</div>
					<div class="form-group">
						<label>Kriteria</label>
						<input type="text" class="form-control" name="nama_kriteria" readonly>
					</div>
					<div class="form-group">
						<label>Nilai</label>
						<select name="kd_kriteria" id="kd_kriteria" class="form-control">
							<option value="">Nilai</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="kd_nilai">
					<button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Tutup</button>
					<button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	var site_url = '<?php echo site_url() ?>';
	$("#kriteria").chained("#jenis");
	$("#nilai").chained("#kriteria");

	function edit(id) {
		$('#modal-edit').modal('show');
		$.ajax({
			type: 'ajax',
			method: 'POST',
			url: site_url + 'input/edit_persyaratan',
			data: {
				kode: id
			},
			dataType: 'json',
			success: function(response) {
				$('[name=kd_nilai]').val(id);
				$('[name=jenis]').val(response.nama_jenis);
				$('[name=nama_siswa]').val(response.nama_siswa);
				$('[name=nama_kriteria]').val(response.nama);
				$('[name=nis]').val(response.nis);

				kriteria = response.nilai_kriteria;
				var html = '<option value="">Pilih Nilai</option>';
				kriteria.forEach(element => {
					html += '<option value="' + element.bobot + '" ' + (response.nilai == element.bobot ? "selected" : "") + '>' + element.keterangan + '</option>';
				});
				$('[name=kd_kriteria]').html(html)
			},
			error: function(xmlresponse) {
				console.log(xmlresponse);
			},
		});
	}
</script>