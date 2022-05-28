<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-info">
	        <div class="panel-heading"><h3 class="text-center">DAFTAR PENDAFTARAN</h3></div>
	        <div class="panel-body">
	            <table class="table table-condensed">
	                <thead>
	                    <tr>
	                        <th>No</th>
	                        <th>NIS</th>
							<th>Nama</th>
							<th>Alamat</th>
	                        <th>Jenis Kelamin</th>
	                        <th>Tahun</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php $no = 1; ?>
	                    <?php foreach($lap_pendaftaran as $pend ) : ?>
	                        <tr>
	                            <td><?=$no++?></td>
								<td><?=$pend->nis?></td>
	                            <td><?=$pend->nama?></td>
	                            <td><?=$pend->alamat?></td>
	                            <td><?=$pend->jenis_kelamin?></td>
	                            <td><?=$pend->tahun_daftar?></td>
	                        </tr>
                        <?php endforeach;?>
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
</div>
