      <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><?= $judul?></a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?= base_url('dashboard')?>">Beranda <span class="sr-only">(current)</span></a></li>
                        
                            <li><a href="<?= base_url('normalisasi')?>">Perhitungan</a></li>
                          
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Input <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="<?= base_url('input/rangking')?>">Data</a></li>
                            <li class="divider"></li>
                            <li><a href="<?= base_url('input/siswa')?>">Data Siswa-Siswi</a></li>
                            <li><a href="<?= base_url('input/kriteria')?>">Kriteria</a></li>
                            <li><a href="<?= base_url('input/penilaian')?>">Penilaian</a></li>
                            <li class="divider"></li>
                            <li><a href="<?= base_url('input/persyaratan')?>">Persyaratan</a></li>
                          </ul>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Laporan <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="<?= base_url('laporan/lap_siswa')?>">Laporan Siswa-Siswi</a></li>
                            <li><a href="<?= base_url('laporan/lap_pendaftaran')?>">Pendaftaran</a></li>
                          </ul>
                        </li>
                        <li><a href="<?= base_url('login/logout')?>">Logout</a></li>
                        <li><a href="#">|</a></li>
                        <li><a href="#" style="font-weight: bold; color: red;"><?= ucfirst($this->userdata['username']) ?></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
      </nav>

      <div class="row">
            <div class="col-md-12">
