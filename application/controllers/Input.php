<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Input extends Auth_Controller
{

    // rangking
    public function rangking()
    {
        $this->load->model('M_input', 'rangking');
        $data['judul'] = 'Rangking';
        $data['rangkings'] = $this->rangking->tampil_rangking()->result();

        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('input/data', $data);
        $this->load->view('templates/footer');
    }

    public function rangking_tambah()
    {
        $this->form_validation->set_rules('nama', 'Nama Jenis Perhitungan', 'required|is_unique[jenis.nama]', [
            'is_unique' => 'Nama Jenis Perhitungan sudah Ada / Telah didaftarkan'
        ]);

        $this->load->model('M_input', 'rangking');


        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Rangking';
            $data['rangkings'] = $this->rangking->tampil_rangking()->result();

            $this->load->view('templates/header');
            $this->load->view('templates/navbar', $data);
            $this->load->view('input/data', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true))
            ];

            $result = $this->rangking->rangking_tambah($data);

            // $this->_sendEmail();
            if ($result > 0) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">
                    Data berhasil Ditambahkan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                );
                redirect('input/rangking');
            } else {
                $data['error'] = 'Data Gagal ditambahkan';
            }
        }
    }

    public function rangking_edit($kode)
    {
        $this->load->model('M_input', 'rangking');
        $data['judul'] = 'Rangking';
        $data['rangkings'] = $this->rangking->tampil_rangking()->result();
        $data['rangkingby_kode'] =  $this->rangking->rangking_by_kode($kode);

        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('input/data_edit', $data);
        $this->load->view('templates/footer');
    }

    public function rangking_editproses()
    {
        $this->load->model('M_input', 'rangking');

        $nama = $this->input->post('nama');
        $kode = $this->input->post('kode');

        $rangking_edit = [
            'nama' => $nama
        ];

        $result = $this->rangking->rangking_edit($rangking_edit, $kode);
        if ($result > 0) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
            Data berhasil diubah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );
            redirect("input/rangking");
        } else {
            $data['error'] = 'Data Gagal diubah';
        }
    }

    public function rangking_hapus($kode)
    {
        $this->load->model('M_input', 'rangking');
        $hapusRangking = $this->rangking->rangking_hapus($kode);
        if ($hapusRangking > 0) {

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data berhasil dihapus :)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect("input/rangking");
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">Data Gagal dihapus!</div>'
            );
        }
    }

    // tutup rangking

    // siswa
    public function siswa()
    {
        $this->load->model('M_input', 'siswa');
        $data['judul'] = 'Siswa';
        $data['siswas'] = $this->siswa->tampil_siswa()->result();

        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('input/siswa', $data);
        $this->load->view('templates/footer');
    }

    public function siswa_tambah()
    {
        $this->form_validation->set_rules('nis', 'NIS', 'required|is_unique[siswa.nis]', [
            'is_unique' => 'NIS tersebut sudah Ada / Telah digunakan'
        ]);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamain', 'required');

        $this->load->model('M_input', 'rangking');


        if ($this->form_validation->run() == false) {
            $this->load->model('M_input', 'siswa');
            $data['judul'] = 'Siswa';
            $data['siswas'] = $this->siswa->tampil_siswa()->result();

            $this->load->view('templates/header');
            $this->load->view('templates/navbar', $data);
            $this->load->view('input/siswa', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nis' => htmlspecialchars($this->input->post('nis', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin', true)),
                'tahun_daftar' => date("Y")
            ];
            $this->load->model('M_input', 'siswa');
            $result = $this->siswa->siswa_tambah($data);

            // $this->_sendEmail();
            if ($result > 0) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">
                    Data berhasil Ditambahkan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                );
                redirect('input/siswa');
            } else {
                $data['error'] = 'Data Gagal ditambahkan';
            }
        }
    }

    public function siswa_edit($nis)
    {
        $this->load->model('M_input', 'siswa');
        $data['judul'] = 'Siswa';
        $data['siswas'] = $this->siswa->tampil_siswa()->result();
        $data['siswaby_nis'] =  $this->siswa->siswa_by_nis($nis);

        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('input/siswa_edit', $data);
        $this->load->view('templates/footer');
    }

    public function siswa_editproses()
    {
        $this->load->model('M_input', 'siswa');

        $nis = $this->input->post('key');

        $siswa_edit = [
            'nis' => $this->input->post('nis'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin')
        ];

        $result = $this->siswa->siswa_edit($siswa_edit, $nis);
        if ($result > 0) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
            Data berhasil diubah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );
            redirect("input/siswa");
        } else {
            $data['error'] = 'Data Gagal diubah';
        }
    }

    public function siswa_hapus($nis)
    {
        $this->load->model('M_input', 'siswa');
        $hapusSiswa = $this->siswa->siswa_hapus($nis);
        if ($hapusSiswa > 0) {

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data berhasil dihapus :)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect("input/siswa");
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">Data Gagal dihapus!</div>'
            );
        }
    }
    //tutup siswa

    // kriteria

    public function kriteria()
    {
        $this->load->model('M_input', 'kriteria');

        $data['judul'] = 'Kriteria';
        $data['kriterias'] = $this->kriteria->tampil_kriteria()->result();
        $data['jenis'] = $this->kriteria->tampil_rangking()->result();

        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('input/kriteria', $data);
        $this->load->view('templates/footer');
    }

    public function kriteria_tambah()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|is_unique[kriteria.nama]', [
            'is_unique' => 'Nama  sudah Ada / Telah didaftarkan'
        ]);

        $this->form_validation->set_rules('bobot', 'Bobot', 'required');

        $this->load->model('M_input', 'kriteria');


        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Kriteria';
            $data['kriterias'] = $this->kriteria->tampil_kriteria()->result();
            $data['jenis'] = $this->kriteria->tampil_rangking()->result();

            $this->load->view('templates/header');
            $this->load->view('templates/navbar', $data);
            $this->load->view('input/kriteria', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'sifat' => $this->input->post('sifat'),
                'bobot' => htmlspecialchars($this->input->post('bobot', true))
            ];

            $result = $this->kriteria->kriteria_tambah($data);

            // $this->_sendEmail();
            if ($result > 0) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">
                    Data berhasil Ditambahkan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                );
                redirect('input/kriteria');
            } else {
                $data['error'] = 'Data Gagal ditambahkan';
            }
        }
    }

    public function kriteria_edit($kode)
    {
        $this->load->model('M_input', 'kriteria');
        $data['judul'] = 'kriteria';
        $data['kriterias'] = $this->kriteria->tampil_kriteria()->result();
        $data['jenis'] = $this->kriteria->tampil_rangking()->result();
        $data['kriteriaby_kode'] =  $this->kriteria->kriteria_by_kode($kode);

        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('input/kriteria_edit', $data);
        $this->load->view('templates/footer');
    }

    public function kriteria_editproses()
    {
        $this->load->model('M_input', 'kriteria');

        $kd_kriteria = $this->input->post('kd_kriteria');

        $kriteria_edit = [
            'kode' => $this->input->post('kode'),
            'nama' => $this->input->post('nama'),
            'sifat' => $this->input->post('sifat'),
            'bobot' => $this->input->post('bobot'),
        ];

        $result = $this->kriteria->kriteria_edit($kriteria_edit, $kd_kriteria);
        if ($result > 0) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
            Data berhasil diubah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );
            redirect("input/kriteria");
        } else {
            $data['error'] = 'Data Gagal diubah';
        }
    }

    public function kriteria_hapus($kd_kriteria)
    {
        $this->load->model('M_input', 'kriteria');
        $hapuskriteria = $this->kriteria->kriteria_hapus($kd_kriteria);
        if ($hapuskriteria > 0) {

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data berhasil dihapus :)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect("input/kriteria");
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">Data Gagal dihapus!</div>'
            );
        }
    }

    // tutup kriteria

    // penilaian

    public function penilaian()
    {
        $this->load->model('M_input', 'penilaian');

        $data['judul'] = 'penilaian';
        $data['penilaians'] = $this->penilaian->tampil_penilaian()->result();
        $data['jenis'] = $this->penilaian->tampil_rangking()->result();
        $data['kriteria'] = $this->penilaian->tampil_kriteria()->result();

        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('input/penilaian', $data);
        $this->load->view('templates/footer');
    }

    public function penilaian_tambah()
    {

        $this->form_validation->set_rules('kode', 'Jenis Perhitungan', 'required');
        $this->form_validation->set_rules('kd_kriteria', 'Kriteria', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('bobot', 'Bobot', 'required');

        $this->load->model('M_input', 'penilaian');


        if ($this->form_validation->run() == false) {
            $data['judul'] = 'penilaian';
            $data['penilaians'] = $this->penilaian->tampil_penilaian()->result();
            $data['jenis'] = $this->penilaian->tampil_rangking()->result();

            $this->load->view('templates/header');
            $this->load->view('templates/navbar', $data);
            $this->load->view('input/penilaian', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'kd_kriteria' => htmlspecialchars($this->input->post('kd_kriteria', true)),
                'keterangan' => $this->input->post('keterangan'),
                'bobot' => htmlspecialchars($this->input->post('bobot', true))
            ];

            $result = $this->penilaian->penilaian_tambah($data);

            // $this->_sendEmail();
            if ($result > 0) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">
                    Data berhasil Ditambahkan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                );
                redirect('input/penilaian');
            } else {
                $data['error'] = 'Data Gagal ditambahkan';
            }
        }
    }

    public function penilaian_edit($kd_penilaian)
    {
        $this->load->model('M_input', 'penilaian');
        $data['judul'] = 'penilaian';
        $data['penilaians'] = $this->penilaian->tampil_penilaian()->result();
        $data['jenis'] = $this->penilaian->tampil_rangking()->result();
        $data['kriteria'] = $this->penilaian->tampil_kriteria()->result();
        $data['penilaianby_kode'] =  $this->penilaian->penilaian_by_kode($kd_penilaian);

        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('input/penilaian_edit', $data);
        $this->load->view('templates/footer');
    }

    public function penilaian_editproses()
    {
        $this->load->model('M_input', 'penilaian');

        $kd_penilaian = $this->input->post('kd_penilaian');

        $penilaian_edit = [
            'kode' => $this->input->post('kode'),
            'kd_kriteria' => $this->input->post('kd_kriteria'),
            'keterangan' => $this->input->post('keterangan'),
            'bobot' => $this->input->post('bobot'),
        ];

        $result = $this->penilaian->penilaian_edit($penilaian_edit, $kd_penilaian);
        if ($result > 0) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
            Data berhasil diubah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );
            redirect("input/penilaian");
        } else {
            $data['error'] = 'Data Gagal diubah';
        }
    }

    public function penilaian_hapus($kd_penilaian)
    {
        $this->load->model('M_input', 'penilaian');
        $hapuspenilaian = $this->penilaian->penilaian_hapus($kd_penilaian);
        if ($hapuspenilaian > 0) {

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data berhasil dihapus :)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect("input/penilaian");
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">Data Gagal dihapus!</div>'
            );
        }
    }

    // tutup penilaian

    // persyaratan
    public function persyaratan()
    {
        $this->load->model('M_input', 'persyaratan');
        $data['judul'] = 'persyaratan';
        $data['siswa'] = $this->persyaratan->tampil_siswa()->result();
        $data['jenis'] = $this->persyaratan->tampil_rangking()->result();
        $data['persyaratans'] = $this->persyaratan->tampil_persyaratan()->result();

        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('input/persyaratan', $data);
        $this->load->view('templates/footer');
    }

    public function persyaratan_detail()
    {
        $this->load->model('M_input', 'persyaratan');
        $data['judul'] = 'persyaratan';
        $data['siswa'] = $this->persyaratan->tampil_siswa()->result();
        $data['penilaians'] = $this->persyaratan->ambilKriteria()->result();
        $data['persyaratans'] = $this->persyaratan->tampil_persyaratan()->result();
        $data['nis'] = $this->input->post('nis');
        $data['kode'] = $this->input->post('kode');
        $kode = $this->input->post('kode');
        $data['nama_jenis'] =  $this->persyaratan->rangking_by_kode($kode);
        $data['allkriteriaby_kode'] =  $this->persyaratan->kriteriaAll_by_kode($kode)->result();


        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('input/persyaratan_detail', $data);
        $this->load->view('templates/footer');
    }

    public function persyaratan_tambah()
    {
        $this->load->model('M_input', 'persyaratan');

        foreach ($_POST["nilai"] as $kd_kriteria => $nilai) {

            $dataCek = [
                'kode' => $this->input->post('kode'),
                'kd_kriteria' => $kd_kriteria,
                'nis' =>  $this->input->post('nis'),
                'nilai' => $nilai
            ];
            $result = $this->persyaratan->persyaratan_cek($dataCek);

            if ($result > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Nilai untuk ' . $_POST["nis"] . ' sudah ada!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect("input/persyaratan");
                exit();
            }
            // var_dump($result);
            unset($dataCek);
            unset($result);
        }

        // if($dataCek === ''){
        foreach ($_POST["nilai"] as $kd_kriteria => $nilai) {
            $data = [
                'kd_nilai' => NULL,
                'kode' => $this->input->post('kode'),
                'kd_kriteria' => $kd_kriteria,
                'nis' =>  $this->input->post('nis'),
                'nilai' => $nilai
            ];
            $result = $this->persyaratan->persyaratan_tambah($data);

            unset($data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data berhasil ditambahkan :)
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect("input/persyaratan");
        // }
    }

    public function persyaratan_edit($kode)
    {
        $this->load->model('M_input', 'persyaratan');
        $data['judul'] = 'persyaratan';
        $data['persyaratans'] = $this->persyaratan->tampil_persyaratan()->result();
        $data['persyaratanby_kode'] =  $this->persyaratan->persyaratan_by_kode($kode);

        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('input/persyaratan_edit', $data);
        $this->load->view('templates/footer');
    }

    public function persyaratan_editproses()
    {
        $this->load->model('M_input', 'persyaratan');

        $nama = $this->input->post('nama');
        $kode = $this->input->post('kode');

        $persyaratan_edit = [
            'nama' => $nama
        ];

        $result = $this->persyaratan->persyaratan_edit($persyaratan_edit, $kode);
        if ($result > 0) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
            Data berhasil diubah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );
            redirect("input/persyaratan");
        } else {
            $data['error'] = 'Data Gagal diubah';
        }
    }

    public function persyaratan_hapus($kode)
    {
        $this->load->model('M_input', 'persyaratan');
        $hapuspersyaratan = $this->persyaratan->persyaratan_hapus($kode);
        if ($hapuspersyaratan > 0) {

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data berhasil dihapus :)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect("input/persyaratan");
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">Data Gagal dihapus!</div>'
            );
        }
    }

    public function edit_persyaratan()
    {
        $this->load->model('M_input', 'persyaratan');
        $result = $this->persyaratan->edit_persyaratan($this->input->post('kode'));
        echo json_encode($result);
    }

    public function update_persyaratan()
    {
        $this->load->model('M_input', 'persyaratan');
        $params = $this->input->post(null, true);

        $result = $this->persyaratan->update_persyaratan($params);
        if ($result) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data berhasil diperbarui :)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">Data Gagal diupdate!</div>'
            );
        }
        redirect("input/persyaratan");

    }

    // tutup persyaratan

}
