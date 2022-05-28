<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="text-center">Matriks Kecocokan</h3>
            </div>
            <div class="panel-body">
                <table class="table table-condensed table-bordered">
                    <thead>
                        <tr class="active">
                            <th class="col-md-1 text-center">No</th>
                            <?php
                            $no = 1;
                            foreach ($table1 as $item => $value) {
                                foreach ($value as $heading => $itemValue) {
                            ?>
                                    <th class="text-center"><?php echo str_replace("_", " ", $heading) ?></th>
                            <?php
                                }
                                break;
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($table1 as $item => $value) {
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no ?></td>
                                <?php
                                foreach ($value as $itemValue) {
                                ?>
                                    <td><?php echo $itemValue ?></td>
                                <?php
                                }
                                ?>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="text-center">Normalisasi</h3>
            </div>
            <div class="panel-body">
                <table class="table table-condensed table-bordered">
                    <thead>
                        <tr class="active">
                            <th class="col-md-1 text-center">No</th>
                            <?php
                            $no = 1;
                            foreach ($table2 as $item => $value) {
                                foreach ($value as $heading => $itemValue) {
                            ?>
                                    <th class="text-center"><?php echo str_replace("_", " ", $heading) ?></th>
                            <?php
                                }
                                break;
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($table2 as $item => $value) {
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no ?></td>
                                <?php
                                foreach ($value as $itemValue) {
                                ?>
                                    <td><?php echo $itemValue ?></td>
                                <?php
                                }
                                ?>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
                <div class="table-responsive ">
                    <table class="table table-bordered">
                        <tr class="active">
                            <th class="col-md-1 text-center">No</th>
                            <th class="text-center">Kriteria</th>
                            <th class="text-center">Sifat</th>
                            <th class="text-center">Nilai min /max</th>
                        </tr>
                        <?php
                        $no = 1;
                        foreach ($dataSifat as $item => $value) {
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no ?></td>
                                <td><?php echo str_replace("_", " ", $item) ?></td>
                                <td><?php echo $value->sifat ?></td>
                                <td>
                                    <?php
                                    if (isset($valueMinMax['min' . $item])) {
                                        echo $valueMinMax['min' . $item] . ' - Minimal';
                                    }
                                    if (isset($valueMinMax['max' . $item])) {
                                        echo $valueMinMax['max' . $item] . ' - Maksimal';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="text-center">Matriks Preferensi</h3>
            </div>
            <div class="panel-body">
                <table class="table table-condensed table-bordered">
                    <thead>
                        <tr class="active">
                            <th class="col-md-1 text-center">No</th>
                            <?php
                            $no = 1;
                            foreach ($table3 as $item => $value) {
                                foreach ($value as $heading => $itemValue) {
                            ?>
                                    <th class="text-center"><?php echo str_replace("_", " ", $heading) ?></th>
                            <?php
                                }
                                break;
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($table3 as $item => $value) {
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no ?></td>
                                <?php
                                foreach ($value as $itemValue) {
                                ?>
                                    <td><?php echo $itemValue ?></td>
                                <?php
                                }
                                ?>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
                <div class="table-responsive ">
                    <table class="table table-bordered">
                        <tr class="active">
                            <th class="col-md-1 text-center">No</th>
                            <th class="text-center">Kriteria</th>
                            <th class="text-center">Bobot</th>
                        </tr>
                        <?php
                        $no = 1;
                        foreach ($bobot as $item => $value) {
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no ?></td>
                                <td><?php echo $value->nama ?></td>
                                <td class="text-center"><?php echo $value->bobot ?></td>

                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="text-center">Rangking</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr class="active">
                            <th class="col-md-1 text-center">No</th>
                            <?php
                            $no = 1;
                            $table = $tableFinal;
                            foreach ($table as $item => $value) {
                                foreach ($value as $heading => $itemValue) {
                            ?>
                                    <th class="text-center"><?php echo str_replace("_", " ", $heading) ?></th>
                            <?php
                                }
                                break;
                            }
                            ?>
                        </tr>
                        <?php
                        foreach ($table as $item => $value) {
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no ?></td>
                                <?php
                                foreach ($value as $itemValue) {
                                ?>
                                    <td><?php echo $itemValue ?></td>
                                <?php
                                }
                                ?>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </table>
                </div>
                <?php
                $table = $tableFinal;
                foreach ($table as $item => $value) {
                    if ($value->Rangking == 1) {
                ?>
                        <div class="alert alert-success" role="alert">
                            <h4><b>Kesimpulan : </b> Dari hasil perhitungan yang dilakukan menggunakan metode SAW
                                Siswa terbaik untuk di pilih adalah
                                <?php echo $value->Siswa ?> dengan nilai <?php echo $value->Total ?>
                            </h4>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>