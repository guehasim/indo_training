<?php 

/**
 * 
 */
class Department extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('m_dept');
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
			$data['dept'] = $this->m_dept->lihat_data();
			$this->load->view('template/header');
			$this->load->view('Employee/v_dept',$data);
			$this->load->view('template/footer');
		}		
	}
	public function simpan()
	{
		$dept = $this->input->post('nama');

		$this->db->where('NamaDept', $dept);
		$query = $this->db->get('m_department');

		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('msg',
						'<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Department Sudah Ada !!
						</div>');
			redirect('Department');
		}else{
			if (isset($_POST)) {
			$this->m_dept->simpan_data();
			$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Berhasil Menyimpan
						</div>');
			redirect('Department');
			}
		}		
	}

	public function update()
	{
		$id 	= $this->input->post('id');
		$dept 	= $this->input->post('nama');

		$data = array(
			'NamaDept'		=> $dept
			);

		$where = array(
			'ID_Dept' 		=> $id
			);

		$this->m_dept->update_data($where,$data,'m_department');

		$this->session->set_flashdata('msg',
				'<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
				</div>');
		redirect('Department');
	}

	public function delete()
	{
		$id = $this->input->post('id');
        $this->m_dept->hapus_data($id);

        $this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
				</div>');
        redirect('Department');
	}
}
 ?>