<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function index()
	{
		if ($this->session->userdata('username')) {
			redirect('home');
		}

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Form Login';
			$this->load->view('login/v_login', $data);
		} else {
			//validasinya sukses
			$this->_masuk();
		}
	}

	private function _masuk()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['username' => $username])->row_array();

		//jika usernya ada
		if ($user) {
			//cek password
			if ($password == $user['password']) {
				$data = [
					'username' => $user['username'],
					'nama_lengkap' => $user['nama_lengkap'],
					'role_id' => $user['role_id'],
					'id_user' => $user['id_user'],
					'foto' => $user['foto']
				];
				$this->session->set_userdata($data);
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
				'<div class="alert alert-danger" role="alert">Akun anda tidak ditemukan!</div>'
			);
			redirect('login');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success" role="alert">Anda telah Logout</div>'
		);
		redirect('login');
	}


	public function blocked()
	{

		$this->load->view('template/not_found');
	}
}
