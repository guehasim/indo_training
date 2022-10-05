<?php 


class login extends CI_Controller
{
	
	public function index()
	{
		$this->load->view('login/index');
	}

	public function aksi_login()
	{
		$user = $this->input->post('user');
		$pass = sha1(md5($this->input->post('pass')));

		$this->db->where('Username', $user);
		$this->db->where('PassUser', $pass);
		$query = $this->db->get('m_user');

		if ($query->num_rows() > 0) {
			$row = $query->row();
			$data = array(
				'ses_IdUser'	=> $row->ID_User,
				'ses_NikUser'	=> $row->NikUser,
				'ses_NamaUser'	=> $row->NamaUser
				);
			$this->session->set_userdata($data);			
				redirect('Admin');
		}else{
			// echo "tidak bisa login";
			$this->session->set_flashdata('msg','Ada kesalahan dalam Login, Periksa Username atau Password');
			redirect('login');
		}
	}

	public function logout()
	{
		session_destroy();

		redirect('admin');
	}
}
 ?>