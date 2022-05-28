<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-info">
	        <div class="panel-heading"><h3 class="text-center">Laporan Nilai Seluruh Siswa-Siswi</h3></div>
	        <div class="panel-body">
				<form class="form-inline" action="<?= base_url('laporan/lap_siswa')?>" method="post">
					<label for="tahun">Tahun :</label>
					<select class="form-control" name="tahun">
						<option>---</option>
						<?php
                        for($i=date('Y'); $i>=date('Y')-32; $i-=1) {?>
                           <option value="<?= $i ?>"> <?= $i?> </option>;
                        <?php 
                        }
                        ?>
					</select>
					<button type="submit" class="btn btn-primary">Tampilkan</button>
				</form>
				<!-- <?php if($akhir != '') :
				?> -->
				<hr>
				<table class="table table-condensed">
	                <thead>
	                    <tr>
							<th>Rangking</th>
							<th>NIM</th>
							<th>Nama</th>
							<th>Nilai</th>
							
							
	                    </tr>
	                </thead>
					<tbody>
					<?php $no = 1; ?>
					<?php foreach($akhir as $key => $val): ?>
						<tr>
							<td><?=$no++?></td>
							<?php $x = explode("-", $key); ?>
							<td><?=$x[0]?></td>
							<td><?=$x[1]?></td>
							<?php foreach ($val as $v): ?>
								<td><?=number_format($v, 8)?></td>
							<?php endforeach; ?>
							
						</tr>
					<?php endforeach ?>
					</tbody>
		            </table>
	            <?php endif; ?>
	        </div>
	    </div>
	</div>
</div>
