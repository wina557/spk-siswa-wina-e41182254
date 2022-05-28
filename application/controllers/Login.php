<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Ci_Controller {

	public function index()
	{
        // $this->load->view('login');
        if (!empty($_SESSION['userdata'])){
			if ($_SESSION['userdata']['posisi'] == 'petugas' || $_SESSION['userdata']['posisi'] == 'puket' || $_SESSION['userdata']['posisi'] == 'mahasiswa') {
				redirect('dashboard');
			}
			
		}else{

            $this->form_validation->set_rules('username', 'username', 'trim|required');
            $this->form_validation->set_rules('password', 'password', 'trim|required');

            if ($this->form_validation->run() == false) {
                $this->load->view('login');
            } else {
                //validasinya sukses
                $this->_masuk();
            }
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[pengguna.username]', [
            'is_unique' => 'Username telah di daftarkan sebelumnya!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Form Registrasi';
            $this->load->view('register', $data);
        } else {
            $data = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'status' => htmlspecialchars($this->input->post('status', true))
            ];

            $this->db->insert('pengguna', $data);

            // $this->_sendEmail();

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">Registrasi berhasil. Silahkan Login</div>'
            );
            redirect('login');
        }
    }

    private function _masuk()
    {

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        

        $user = $this->db->get_where('pengguna', ['username' => $username])->row_array();

        //jika usernya ada
        if ($user) {
            //cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'username' => $user['username'],
                    'posisi' => $user['status'],
                    'email' => $user['email']
                ];
                $session = array('userdata' => $data,
                                'status' => "Loged in" 
                            );
                $this->session->set_userdata($session);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">Password anda salah</div>'
                );
                redirect('login');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">Username tidak ditemukan!</div>'
            );
            redirect('login');
        }

    }
    public function logout()
    {
        session_destroy();
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">Anda telah Logout</div>'
        );
        redirect('login');
    }
}