<?php 

/**
 * 
 */
class Subsection extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('m_subs');
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
			$data['subs'] = $this->m_subs->lihat_data();
			$this->load->view('template/header');
			$this->load->view('Employee/v_subs',$data);
			$this->load->view('template/footer');
		}		
	}
	public function simpan()
	{
		$subs = $this->input->post('nama');

		$this->db->where('NamaSubs', $subs);
		$query = $this->db->get('m_subsection');

		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('msg',
						'<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Subsection Sudah Ada !!
						</div>');
			redirect('Subsection');
		}else{
			if (isset($_POST)) {
			$this->m_subs->simpan_data();
			$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Berhasil Menyimpan
						</div>');
			redirect('Subsection');
			}
		}		
	}

	public function update()
	{
		$id 	= $this->input->post('id');
		$subs 	= $this->input->post('nama');

		$data = array(
			'Namasubs'		=> $subs
			);

		$where = array(
			'ID_Subs' 		=> $id
			);

		$this->m_subs->update_data($where,$data,'m_subsection');

		$this->session->set_flashdata('msg',
				'<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
				</div>');
		redirect('Subsection');
	}

	public function delete()
	{
		$id = $this->input->post('id');
        $this->m_subs->hapus_data($id);

        $this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
				</div>');
        redirect('Subsection');
	}
}
 ?>