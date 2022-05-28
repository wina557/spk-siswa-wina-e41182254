<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Normalisasi extends Auth_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('saw/MKriteria');
        $this->load->model('saw/MNilai');
        $this->load->model('saw/MSiswa');
        $this->load->model('saw/MSAW');
    }

    public function index()
    {
        $siswa = $this->MSiswa->getAll();

        /**
         * Menghapus table SAW jika ada
         */
        $this->MSAW->dropTable();
        $this->MSiswa->resetHasil();

        /**
         * $kriteria data dari table kriteria
         */
        $kriteria = $this->MKriteria->getAll();

        /**
         * membuat table SAW berdasarkan data dari table kriteria
         * menginputkan semua data nilai
         */
        $this->MSAW->createTable($kriteria);

        /**
         * Ambil data dari table SAW untuk perhitungan awal
         */
        $table1 = $this->initialTableSAW($siswa);
        $data['table1'] = $table1;
        // $this->page->setData('table1', $table1);


        /**
         * mengambil sifat kriteria
         * @var $dataSifat array
         */
        $dataSifat = $this->getDataSifat();
        $data['dataSifat'] = $dataSifat;
        // $this->page->setData('dataSifat', $dataSifat);

        /**
         * Mengambil nilai maksimal dan minimal berdasarkan sifat
         */
        $dataValueMinMax = $this->getVlueMinMax($dataSifat);
        $data['valueMinMax'] = $dataValueMinMax;
        // $this->page->setData('valueMinMax', $dataValueMinMax);

        /**
         * Proses 1 ubah data berdasarkan sifat
         */

        $table2 = $this->getCountBySifat($dataSifat, $dataValueMinMax);
        $data['table2'] = $table2;
        // $this->page->setData('table2', $table2);

        /**
         * Hitung perkalian bobot dengan nilai kriteria
         */
        $bobot = $this->MKriteria->getBobotKriteria();
        $data['bobot'] = $bobot;
        // $this->page->setData('bobot', $bobot);
        $table3 = $this->getCountByBobot($bobot);
        $data['table3'] = $table3;
        // $this->page->setData('table3', $table3); 

        /**
         * Add kolom total dan rangking
         */
        $this->MSAW->addColumnTotalRangking();

        /**
         * Menghitung nilai total
         */
        $this->countTotal();

        /**
         * Mengambil data yang sudah di rangking
         */
        $tableFinal = $this->getDataRangking();

        $keys = array_column($tableFinal, 'Rangking');
        array_multisort($keys, SORT_ASC, $tableFinal);
        $data['tableFinal'] = $tableFinal;

        $store = [];
        if (!empty($tableFinal)) {
            foreach ($tableFinal as $key => $value) {
                $dtsiswa = $this->MSiswa->castingNIM($value->Siswa);
                $store[$key]['kode'] = '2';
                $store[$key]['nis'] = $dtsiswa['nis'];
                $store[$key]['nama'] = $value->Siswa;
                $store[$key]['nilai'] = $value->Total;
                $store[$key]['rangking'] = $value->Rangking;
                $store[$key]['tahun'] = $dtsiswa['tahun_daftar'];
                $this->MSiswa->simpanHasil($store[$key]);
            }
        }
        // $this->page->setData('tableFinal', $tableFinal);

        /**
         * Menghapus table SAW
         */
        $this->MSAW->dropTable();
        $data['judul'] = 'normalisasi';
        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('normalisasi');
        $this->load->view('templates/footer');
    }

    private function initialTableSAW($siswa)
    {
        $nilai = $this->MNilai->getNilaiSiswa();

        $dataInput = array();
        $no = 0;
        foreach ($siswa as $item => $iteMSiswa) {
            foreach ($nilai as $index => $itemNilai) {
                if ($iteMSiswa->nis == $itemNilai->nis) {
                    $dataInput[$no]['Siswa'] = $iteMSiswa->nama;
                    $dataInput[$no][str_replace(" ", "_", strtolower($itemNilai->kriteria))] = $itemNilai->nilai;
                }
            }
            $no++;
        }

        foreach ($dataInput as $data => $item) {
            $this->MSAW->insert($item);
        }
        return $this->MSAW->getAll();
    }

    private function getDataSifat()
    {
        $sawData = $this->MSAW->getAll();
        $dataSifat = array();
        foreach ($sawData as $item => $value) {
            foreach ($value as $x => $z) {
                if ($x == 'Siswa') {
                    continue;
                }
                $dataSifat[$x] = $this->MSAW->getStatus($x);
            }
        }
        return $dataSifat;
    }

    private function getVlueMinMax($dataSifat)
    {
        $sawData = $this->MSAW->getAll();
        $dataValueMinMax = array();
        foreach ($sawData as $point => $value) {
            foreach ($value as $x => $z) {
                if ($x == 'Siswa') {
                    continue;
                }
                foreach ($dataSifat as $item => $itemX) {
                    if ($x == $item) {

                        if ($x == $item && $itemX->sifat == 'max') {
                            if (!isset($dataValueMinMax['max' . $x])) {
                                $dataValueMinMax['kriteria' . $x] = $x;
                                $dataValueMinMax['max' . $x] = $z;
                                $dataValueMinMax['sifat' . $x] = 'Benefit';
                            } elseif ($z > $dataValueMinMax['max' . $x]) {
                                $dataValueMinMax['max' . $x] = $z;
                            }
                        } else {
                            if (!isset($dataValueMinMax['min' . $x])) {
                                $dataValueMinMax['kriteria' . $x] = $x;
                                $dataValueMinMax['min' . $x] = $z;
                                $dataValueMinMax['sifat' . $x] = 'Cost';
                            } elseif ($z < $dataValueMinMax['min' . $x]) {
                                $dataValueMinMax['min' . $x] = $z;
                            }
                        }
                    }
                }
            }
        }

        return $dataValueMinMax;
    }

    private function getCountBySifat($dataSifat, $dataValueMinMax)
    {
        $sawData = $this->MSAW->getAll();
        foreach ($sawData as $point => $value) {
            foreach ($value as $x => $z) {
                if ($x == 'Siswa') {
                    continue;
                }
                foreach ($dataSifat as $item => $sifat) {
                    if ($x == $item) {
                        if ($sifat->sifat == 'max') {

                            $newData = $z / $dataValueMinMax['max' . $x];
                            $dataUpdate = array(
                                $x => $newData
                            );
                            $where = array(

                                'Siswa' => $value->Siswa
                            );

                            $this->MSAW->update($dataUpdate, $where);
                        } else {
                            $newData = $dataValueMinMax['min' . $x] / $z;
                            $dataUpdate = array(
                                $x => $newData
                            );
                            $where = array(

                                'Siswa' => $value->Siswa
                            );

                            $this->MSAW->update($dataUpdate, $where);
                        }
                    }
                }
            }
        }

        return $this->MSAW->getAll();
    }

    private function countTotal()
    {
        $sawData = $this->MSAW->getAll();

        foreach ($sawData as $item => $value) {
            $total = 0;
            foreach ($value as $item => $itemData) {
                if ($item == 'Siswa') {
                    continue;
                } elseif ($item == 'Total') {
                    $dataUpdate = array(
                        'Total' => $total
                    );

                    $where = array(
                        'Siswa' => $value->Siswa
                    );

                    $this->MSAW->update($dataUpdate, $where);
                } else {
                    $total = $total + $itemData;
                }
            }
        }
    }

    private function getCountByBobot($bobot)
    {
        $sawData = $this->MSAW->getAll();
        foreach ($sawData as $point => $value) {
            foreach ($value as $x => $z) {
                if ($x == 'Siswa') {
                    continue;
                }
                foreach ($bobot as $item => $itemKriteria) {

                    if ($x == str_replace(' ', '_', strtolower($itemKriteria->nama))) {

                        $sawData[$point]->$x =  $z * $itemKriteria->bobot;
                        $newData = $z * $itemKriteria->bobot;
                        $dataUpdate = array(
                            $x => $newData
                        );
                        $where = array(
                            'Siswa' => $value->Siswa
                        );

                        $this->MSAW->update($dataUpdate, $where);
                    }
                }
            }
        }

        return $this->MSAW->getAll();
    }

    private function getDataRangking()
    {
        $sawData = $this->MSAW->getSortTotalByDesc();
        $no = 1;
        foreach ($sawData as $item => $value) {
            $dataUpdate = array(
                'Rangking' => $no
            );
            $where = array(
                'Siswa' => $value->Siswa
            );

            $this->MSAW->update($dataUpdate, $where);
            $no++;
        }
        return $this->MSAW->getAll();
    }
}
