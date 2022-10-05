<?php 


class Training extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('m_training');
	}

	//==================================================training

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
			$data['training'] = $this->m_training->lihat_data();
			$this->load->view('template/header');
			$this->load->view('training/index',$data);
			$this->load->view('template/footer');
		}		
	}
	public function simpan()
	{
		$nama = $this->input->post('nama');

		$this->db->where('NamaTraining', $nama);
		$query = $this->db->get('m_training');

		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('msg',
						'<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Course ini Sudah Ada !!
						</div>');
			redirect('Training');
		}else{
			if (isset($_POST)) {
			$this->m_training->simpan_data();
			$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Berhasil Menyimpan
						</div>');
			redirect('Training');
			}
		}		
	}

	public function update()
	{
		$id 	= $this->input->post('id');
		$dept 	= $this->input->post('nama');

		$data = array(
			'NamaTraining'		=> $dept
			);

		$where = array(
			'ID_Training' 		=> $id
			);

		$this->m_training->update_data($where,$data,'m_training');

		$this->session->set_flashdata('msg',
				'<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
				</div>');
		redirect('Training');
	}

	public function delete()
	{
		$id = $this->input->post('id');
        $this->m_training->hapus_data($id);

        $this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
				</div>');
        redirect('Training');
	}

	//=====================================================detail training


	public function tampil_detail()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
			if (isset($_GET['us'])) {
				$id = $_GET['us'];
				$data['judul'] 		= $this->m_training->get_data($id);
				$data['training'] 	= $this->m_training->lihat_detail($id);
				$this->load->view('template/header');
				$this->load->view('training/detail',$data);
				$this->load->view('template/footer');
			}			
		}		
	}

	public function simpan_detail()
	{
		if (isset($_POST)) {
			$this->m_training->simpan_detail();
			$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Berhasil Menyimpan
						</div>');
			redirect('./Training/tampil_detail?us='.$_POST[id_training].'');
			}		
	}



	public function update_detail()
	{

		$data = array(
			'NamaMateri' 			=> $this->input->post('nama'),
			'Trainer' 				=> $this->input->post('trainer'),
			'Lokasi' 				=> $this->input->post('lokasi'),
			'ReportBy' 				=> $this->input->post('report'),
			'Duration' 				=> $this->input->post('durasi')
			);

		$where = array(
			'ID_DetailTraining' 	=> $this->input->post('id')
			);

		$this->m_training->update_data($where,$data,'detail_training');

		$this->session->set_flashdata('msg',
				'<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
				</div>');
		redirect('./Training/tampil_detail?us='.$_POST[id_training].'');
	}

	public function delete_detail()
	{
		$id = $this->input->post('id');
        $this->m_training->hapus_detail($id);

        $this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
				</div>');
        redirect('./Training/tampil_detail?us='.$_POST[id_training].'');
	}

}
 ?>