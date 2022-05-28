<div class="row">
	<div class="col-md-4">
	    <div class="panel panel-warning">
	        <div class="panel-heading"><h3 class="text-center">Edit</h3></div>
	        <div class="panel-body">
	            <form action="<?= base_url('input/penilaian_editproses')?>" method="POST">
                <input type="hidden" name="kd_penilaian" value="<?= $penilaianby_kode->kd_penilaian ?>">
					<div class="form-group">
	                  <label for="kode">Jenis Perhitungan</label>
						<select class="form-control" name="kode" id="jenis">
						    <option value="">---</option>
							<?php foreach($jenis as $jen) : ?>
							    <option value="<?=$jen->kode?>"  <?= ($penilaianby_kode->kode != $jen->kode) ?: 'selected="selected"' ?>><?=$jen->nama?></option>
                            <?php endforeach; ?>							
						</select>
                        <small class="text-danger">
                            <?= form_error('kode') ?>
                         </small>
					</div>
					<div class="form-group">
	                  <label for="kd_kriteria">Kriteria</label>
					    <select class="form-control" name="kd_kriteria" id="kriteria">
							<option>---</option>
                            <?php foreach($kriteria as $ket) : ?>
							<option value="<?=$ket->kd_kriteria?>" class="<?=$ket->kode?>" <?= ($penilaianby_kode->kd_kriteria != $ket->kd_kriteria) ?: 'selected="selected"' ?>><?=$ket->nama?></option>
                            <?php endforeach; ?>
						</select>
                        <small class="text-danger">
                            <?= form_error('kd_kriteria') ?>
                         </small>
					</div>
	                <div class="form-group">
	                    <label for="keterangan">Keterangan</label>
	                    <input type="text" name="keterangan" class="form-control" value=" <?= $penilaianby_kode->keterangan?>">
                        <small class="text-danger">
                            <?= form_error('keterangan') ?>
                         </small>
	                </div>
	                <div class="form-group">
	                    <label for="bobot">Bobot</label>
	                    <input type="text" name="bobot" class="form-control" value=" <?= $penilaianby_kode->bobot ?>">
                        <small class="text-danger">
                            <?= form_error('bobot') ?>
                         </small>
	                </div>
	                <button type="submit" class="btn btn-info btn-block">Simpan</button>
	            </form>
	        </div>
	    </div>
	</div>
	<div class="col-md-8">
	    <div class="panel panel-info">
	        <div class="panel-heading"><h3 class="text-center">DAFTAR</h3></div>
	        <div class="panel-body">
                <?php if ($this->session->flashdata('message')) :
                  echo $this->session->flashdata('message');
                endif; ?>
	            <table class="table table-condensed">
	                <thead>
	                    <tr>
	                        <th>No</th>
	                        <th>Jenis Perhitungan</th>
	                        <th>Kriteria</th>
	                        <th>Keterangan</th>
	                        <th>Bobot</th>
	                        <th></th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php $no = 1; ?>
	                    <?php foreach($penilaians as $penilaian) : ?>
	                        <tr>
	                            <td><?=$no++?></td>
	                            <td><?= $penilaian->nama_jenis ?></td>
	                            <td><?= $penilaian->nama_kriteria?></td>
	                            <td><?= $penilaian->keterangan ?></td>
	                            <td><?= $penilaian->bobot ?></td>
	                            <td>
	                                <div class="btn-group">
                                        <a href="<?= base_url('input/penilaian_edit/'.$penilaian->kd_penilaian)?>" class="btn btn-light btn-xs">Edit</a>
	                                    <a onclick="return konfirmasi()" href="<?= base_url('input/penilaian_hapus/'.$penilaian->kd_penilaian) ?>" class="btn btn-danger btn-xs">Hapus</a>
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

<script type="text/javascript">
$("#kriteria").chained("#jenis");
</script>
