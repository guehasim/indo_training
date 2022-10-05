<?php 


class Education extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('m_education');
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
			$data['edu'] = $this->m_education->lihat_data();
			$this->load->view('template/header');
			$this->load->view('Employee/v_education',$data);
			$this->load->view('template/footer');
		}		
	}
	public function simpan()
	{
		$dept = $this->input->post('nama');

		$this->db->where('Namaeducation', $dept);
		$query = $this->db->get('m_education');

		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('msg',
						'<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Education Sudah Ada !!
						</div>');
			redirect('education');
		}else{
			if (isset($_POST)) {
			$this->m_education->simpan_data();
			$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Berhasil Menyimpan
						</div>');
			redirect('Education');
			}
		}		
	}

	public function update()
	{
		$id 	= $this->input->post('id');
		$dept 	= $this->input->post('nama');

		$data = array(
			'NamaEducation'		=> $dept
			);

		$where = array(
			'ID_Education' 		=> $id
			);

		$this->m_education->update_data($where,$data,'m_education');

		$this->session->set_flashdata('msg',
				'<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
				</div>');
		redirect('Education');
	}

	public function delete()
	{
		$id = $this->input->post('id');
        $this->m_education->hapus_data($id);

        $this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
				</div>');
        redirect('Education');
	}
}
 ?>