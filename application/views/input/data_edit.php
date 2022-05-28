<div class="row">
	<div class="col-md-4">
	    <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="text-center">Edit</h3>
                <?php  if ($this->session->flashdata()) : ?>
                    <?= $this->session->flashdata('message-form'); ?>
                <?php endif; ?>
            </div>
	        <div class="panel-body">
                <form action="<?= base_url('input/rangking_editproses')?>" method="POST">
                    <input type="hidden" name="kode" value="<?= $rangkingby_kode->kode?>">
	                <div class="form-group">
	                    <label for="nama">Jenis Perhitungan</label>
                        <input type="text" name="nama" class="form-control" value="<?= $rangkingby_kode->nama?>">
                        <small class="text-danger">
                            <?= form_error('nama') ?>
                         </small>
	                </div>
                    <button type="submit" class="btn btn-success btn-block">Simpan</button>
                    <a href="<?= base_url('input/rangking')?>" class="btn btn-info btn-block">Batal</a>
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
	                        <th></th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php $no = 1; ?>
                        <?php foreach ($rangkings as $rangking) :?>
	                        <tr>
	                            <td><?=$no++?></td>
	                            <td><?=$rangking->nama?></td>
	                            <td>
	                                <div class="btn-group">
	                                    <a href="<?= base_url('input/rangking_edit/'.$rangking->kode) ?>" class="btn btn-light btn-xs">Edit</a>
	                                    <a onclick="return konfirmasi()" href="<?= base_url('input/rangking_hapus/'.$rangking->kode) ?>" class="btn btn-danger btn-xs">Hapus</a>
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