<?php 

/**
 * 
 */
class Checker extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('m_checker');
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
			$data['checker'] = $this->m_checker->lihat_data();
			$this->load->view('template/header');
			$this->load->view('Employee/v_checker',$data);
			$this->load->view('template/footer');
		}		
	}
	public function simpan()
	{
		$subs = $this->input->post('nama');

		$this->db->where('NamaChecker', $subs);
		$query = $this->db->get('m_checker');

		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('msg',
						'<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Checker Sudah Ada !!
						</div>');
			redirect('Checker');
		}else{
			if (isset($_POST)) {
			$this->m_checker->simpan_data();
			$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Berhasil Menyimpan
						</div>');
			redirect('Checker');
			}
		}		
	}

	public function update()
	{
		$id 	= $this->input->post('id');
		$subs 	= $this->input->post('nama');

		$data = array(
			'NamaChecker'		=> $subs
			);

		$where = array(
			'ID_Checker' 		=> $id
			);

		$this->m_checker->update_data($where,$data,'m_checker');

		$this->session->set_flashdata('msg',
				'<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
				</div>');
		redirect('Checker');
	}

	public function delete()
	{
		$id = $this->input->post('id');
        $this->m_checker->hapus_data($id);

        $this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
				</div>');
        redirect('Checker');
	}
}
 ?>