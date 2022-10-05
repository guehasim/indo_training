<?php 

/**
 * 
 */
class Position extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('m_position');
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
			$data['posisi'] = $this->m_position->lihat_data();
			$this->load->view('template/header');
			$this->load->view('Employee/v_position',$data);
			$this->load->view('template/footer');
		}		
	}
	public function simpan()
	{
		$subs = $this->input->post('nama');

		$this->db->where('NamaPosition', $subs);
		$query = $this->db->get('m_position');

		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('msg',
						'<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Position Sudah Ada !!
						</div>');
			redirect('Position');
		}else{
			if (isset($_POST)) {
			$this->m_position->simpan_data();
			$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Berhasil Menyimpan
						</div>');
			redirect('Position');
			}
		}		
	}

	public function update()
	{
		$id 	= $this->input->post('id');
		$subs 	= $this->input->post('nama');

		$data = array(
			'NamaPosition'		=> $subs
			);

		$where = array(
			'ID_Position' 		=> $id
			);

		$this->m_position->update_data($where,$data,'m_position');

		$this->session->set_flashdata('msg',
				'<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
				</div>');
		redirect('Position');
	}

	public function delete()
	{
		$id = $this->input->post('id');
        $this->m_position->hapus_data($id);

        $this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
				</div>');
        redirect('Position');
	}
}
 ?>