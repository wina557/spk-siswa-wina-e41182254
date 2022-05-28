<div class="row">
	<div class="col-md-4">
	    <div class="panel panel-info">
	        <div class="panel-heading"><h3 class="text-center">TAMBAH</h3></div>
	        <div class="panel-body">
	            <form action="<?= base_url('input/persyaratan_tambah') ?>" method="post">
				<input type="hidden" name="kode" value="<?= $kode ?>">
				<div class="form-group">
					<label for="nis">Siswa</label>
                    <input type="text" name="nis" value="<?=$nis?>" class="form-control" readonly="on">
				</div>
				<div class="form-group">
	                <label for="kode">Jenis Perhitungan</label>
					<input type="text" value="<?= $nama_jenis->nama?>" class="form-control" readonly="on">
				</div>
            <?php foreach($allkriteriaby_kode as $all) : ?>
                <div class="form-group">
				    <label for="nilai" ><?=ucfirst($all->nama)?></label>
						<select class="form-control" name="nilai[<?=$all->kd_kriteria?>]" id="nilai" required>
							<option>---</option>
						<?php foreach($penilaians as $pen): ?>
							<?php if($pen->kd_kriteria === $all->kd_kriteria) : ?>
                            	<option value="<?=$pen->bobot?>" class="<?=$pen->kd_kriteria?>"><?=$pen->keterangan?></option>
							<?php endif; ?>
                        <?php endforeach; ?>
						</select>
				    </div>
            <?php endforeach; ?>
			   <button type="submit" id="simpan" class="btn btn-info btn-block">Tampilkan</button>
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
	                    <?php foreach($persyaratans as $persyaratan) : ?>
	                        <tr>
	                            <td><?=$no++?></td>
								<td><?=$persyaratan->nis?></td>
								<td><?=$persyaratan->nama_siswa?></td>
	                            <td><?=$persyaratan->nama_jenis?></td>
	                            <td><?=$persyaratan->nama_kriteria?></td>
	                            <td><?=$persyaratan->nilai?></td>
	                            <td>
	                                <div class="btn-group">
                                    <a href="<?= base_url('input/perysaratan_edit/'.$persyaratan->kd_nilai)?>" class="btn btn-light btn-xs">Edit</a>
	                                    <a onclick="return konfirmasi()" href="<?= base_url('input/persyaratan_hapus/'.$persyaratan->kd_nilai) ?>" class="btn btn-danger btn-xs">Hapus</a>
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
<script type="text/javascript">
$("#kriteria").chained("#jenis");
$("#nilai").chained("#kriteria");
</script>