<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="text-center">Edit Data </h3>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('input/persyaratan_detail') ?>" method="post">
					<div class="form-group">
						<label for="nis">Siswa</label>
						<select class="form-control" name="nis">
							<option>---</option>
							<?php foreach ($siswa as $sis) : ?>
								<option value="<?= $sis->nis ?>"><?= $sis->nis ?> | <?= $sis->nama ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="kode">Jenis Perhitungan</label>
						<select class="form-control" name="kode" id="jenis">
							<option>---</option>
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
</div>
<script type="text/javascript">
	$("#kriteria").chained("#jenis");
	$("#nilai").chained("#kriteria");
</script>