<div class="row">
	<div class="col-md-4">
	    <div class="panel panel-info">
	        <div class="panel-heading"><h3 class="text-center">TAMBAH</h3></div>
	        <div class="panel-body">
	            <form action="<?= base_url('input/siswa_tambah')?>" method="POST">
	                <div class="form-group">
	                    <label for="nis">NIS</label>
	                    <input type="text" name="nis" class="form-control" onkeypress="return hanyaAngka(event)">
                        <small class="text-danger">
                            <?= form_error('nis') ?>
                        </small>
	                </div>
	                <div class="form-group">
	                    <label for="nama">Nama Lengkap</label>
	                    <input type="text" name="nama" class="form-control" onkeypress='return harusHuruf(event)'>
                        <small class="text-danger">
                            <?= form_error('nama') ?>
                        </small>
	                </div>
	                <div class="form-group">
	                    <label for="alamat">Alamat</label>
	                    <input type="text" name="alamat" class="form-control">
                        <small class="text-danger">
                            <?= form_error('alamat') ?>
                        </small>
	                </div>
					<div class="form-group">
	                  <label for="jenis_kelamin">Jenis Kelamin</label>
						<select class="form-control" name="jenis_kelamin">
							<option>---</option>
							<option value="Laki-laki">Laki-laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
	                <button type="submit" class="btn btn-info">Simpan</button>
	            </form>
	        </div>
	    </div>
	</div>
	<div class="col-md-8">
	    <div class="panel panel-info"> 
	        <div class="panel-heading"><h3 class="text-center">DAFTAR SISWA-SISWI</h3></div>
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
	                        <th>Alamat</th>
	                        <th>Jenis Kelamin</th>
	                        <th>Tahun</th>
	                        <th></th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php $no = 1; ?>
	                    <?php foreach($siswas as $siswa) :?>
	                        <tr>
	                            <td><?=$no++?></td>
	                            <td><?=$siswa->nis?></td>
	                            <td><?=$siswa->nama?></td>
	                            <td><?=$siswa->alamat?></td>
	                            <td><?=$siswa->jenis_kelamin?></td>
	                            <td><?=$siswa->tahun_daftar?></td>
	                            <td>
	                                <div class="btn-group">
	                                    <a href="<?= base_url('input/siswa_edit/'.$siswa->nis)?>" class="btn btn-light btn-xs">Edit</a>
	                                    <a onclick="return konfirmasi()" href="<?= base_url('input/siswa_hapus/'.$siswa->nis) ?>" class="btn btn-danger btn-xs">Hapus</a>
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
