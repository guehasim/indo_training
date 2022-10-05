<?php 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Log extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_log');
		$this->load->model('m_karyawan');
		$this->load->model('m_training');
		$this->load->model('m_dept');
		// $this->load->model('m_checker');
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
			$data['karyawan'] 	= $this->m_karyawan->lihat_data();
			$data['dept'] 		= $this->m_dept->lihat_data();
			$data['training'] 	= $this->m_training->lihat_detail_all();
			$data['log'] 		= $this->m_log->lihat_data();
			$this->load->view('template/header');
			$this->load->view('Log/index',$data);
			$this->load->view('template/footer');
		}
	}

	public function pilih_id()
	{
		$nik = $_GET['id'];
        $niknya   = $this->db->get_where('m_karyawan',array('NikKaryawan'=>$nik));
        foreach ($niknya->result() as $k)
        {
        	echo "<input type='text' name='id_karyawan' value='$k->ID_Karyawan' class='form-control' hidden>";
        }
	}

	public function pilih_nama()
	{
		$nik = $_GET['id'];

		$this->db->where('NikKaryawan', $nik);
		$query = $this->db->get('m_karyawan');

		if ($query->num_rows() > 0) {
			$niknya   = $this->db->get_where('m_karyawan',array('NikKaryawan'=>$nik));
	        foreach ($niknya->result() as $k)
	        {
	        	echo "<input type='text' value='$k->NamaKaryawan' class='form-control' disabled>";       		
	        	
	        }
		}else{
			echo "<input type='text' class='form-control' disabled>";
		}        
	}

	public function pilih_dept()
	{
		$nik = $_GET['id'];

		$this->db->where('NikKaryawan', $nik);
		$query = $this->db->get('m_karyawan');

		if ($query->num_rows() > 0) {			
			$niknya   = $this->db->get_where('m_karyawan',array('NikKaryawan'=>$nik));
	        foreach ($niknya->result() as $k)
	        {
	        	$id_dept = $this->db->get_where('m_department',array('ID_Dept'=>$k->ID_Dept));
	        	foreach ($id_dept->result() as $l) {
	        		echo "<input type='text' value='$l->NamaDept' class='form-control' disabled>";
	        	}
	        }
		}else{
			echo "<input type='text' class='form-control' disabled>";
		}        
	}

	public function pilih_trainer()
	{
		$list = $_GET['id'];

		$this->db->where('ID_DetailTraining', $list);
		$query = $this->db->get('detail_training');

		if ($query->num_rows() > 0) {
			$listnya   = $this->db->get_where('detail_training',array('ID_DetailTraining'=>$list));
	        foreach ($listnya->result() as $k)
	        {
	        	echo "<input type='text' value='$k->Trainer' class='form-control' disabled>";       		
	        	
	        }
		}else{
			echo "<input type='text' class='form-control' disabled>";
		}        
	}

	public function pilih_lokasi()
	{
		$list = $_GET['id'];

		$this->db->where('ID_DetailTraining', $list);
		$query = $this->db->get('detail_training');

		if ($query->num_rows() > 0) {
			$listnya   = $this->db->get_where('detail_training',array('ID_DetailTraining'=>$list));
	        foreach ($listnya->result() as $k)
	        {
	        	echo "<input type='text' value='$k->Lokasi' class='form-control' disabled>";       		
	        	
	        }
		}else{
			echo "<input type='text' class='form-control' disabled>";
		}        
	}

	public function simpan()
	{
		$subs = $this->input->post('nik');

		$this->db->where('NikKaryawan', $subs);
		$query = $this->db->get('m_karyawan');

		if ($query->num_rows() > 0) {		
			if (isset($_POST)) {
			$this->m_log->simpan_data();
			$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Berhasil Menyimpan
						</div>');
			redirect('Log');
			}
		}else{
			$this->session->set_flashdata('msg',
						'<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Nik tidak sesuai !!
						</div>');
			redirect('Log');
		}
	}

	public function update()
	{
		$nik = $this->input->post('nik');

		$this->db->where('NikKaryawan',$nik);
		$query = $this->db->get('m_karyawan');

		if ($query->num_rows() > 0) {
			$row = $query->row();

				$data = array(			
				'TglPelatihan'			=> date('Y-m-d',strtotime($this->input->post('Tgl'))),
				'TglNow' 				=> date('Y-m-d'),
				'ID_DetailTraining' 	=> $this->input->post('id_detail'),
				'ID_Karyawan' 			=> $row->ID_Karyawan,
				'Pelapor' 				=> $this->input->post('pelapor'),
				'Pemeriksa' 			=> $this->input->post('pemeriksa')
				);

			$where = array(
				'ID_TrainingRecord'		=> $this->input->post('id')
				);

			$this->m_karyawan->update_data($where,$data,'training_record');

			$this->session->set_flashdata('msg',
					'<div class="alert alert-info alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                Berhasil Mengubah
					</div>');
			redirect('Log');
		}else{
			$this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                NIK Tidak ada di data !!!
				</div>');
			redirect('Log');
		}		
	}

	public function delete()
	{
		$id = $this->input->post('id');
        $this->m_log->hapus_data($id);

        $this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
				</div>');
        redirect('Log');
	}

	public function laporan()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user == "") {
			redirect('login');
		}else{
			
			$period_awal  		= date('Y-m-d',strtotime($this->input->post('period_awal')));
			$period_akhir 		= date('Y-m-d',strtotime($this->input->post('period_akhir')));
			$dept 				= $this->input->post('dept');

			$submit = $this->input->post('submitdata');			

			if ($submit == 'Reset') {

				redirect('Log');

			}else if($submit == 'Print'){

				$data['period_awal'] = date('d-m-Y',strtotime($this->input->post('period_awal')));
				$data['period_akhir'] = date('d-m-Y',strtotime($this->input->post('period_akhir')));
				$data['cetak'] = $this->m_log->lihat_pdf($period_awal,$period_akhir,$dept);
				$this->load->view('log/cetak_log',$data);

			}else if($submit == 'Excel'){

				$data['period_awal'] = date('d-m-Y',strtotime($this->input->post('period_awal')));
				$data['period_akhir'] = date('d-m-Y',strtotime($this->input->post('period_akhir')));

				$semua_pengguna = $this->m_log->lihat_pdf($period_awal,$period_akhir,$dept);

				$spreadsheet = new Spreadsheet;

		          $spreadsheet->setActiveSheetIndex(0)
		                      ->setCellValue('A1', 'NO')
		                      ->setCellValue('B1', 'ID NUMBER')
		                      ->setCellValue('C1', 'NAMA')
		                      ->setCellValue('D1', 'DEPARTEMENT')
		                      ->setCellValue('E1', 'TANGGAL PELATIHAN')
		                      ->setCellValue('F1', 'TOPIK PELATIHAN')
		                      ->setCellValue('G1', 'TRAINER')
		                      ->setCellValue('H1', 'LOKASI')
		                      ->setCellValue('I1', 'PELAPOR')
		                      ->setCellValue('J1', 'PEMERIKSA')
		                      ->setCellValue('K1', 'TANGGAL');

		          $kolom = 2;
		          $nomor = 1;
		          foreach($semua_pengguna->result() as $pengguna) {

		               $spreadsheet->setActiveSheetIndex(0)
		                           ->setCellValue('A' . $kolom, $nomor)
		                           ->setCellValue('B' . $kolom, $pengguna->NikKaryawan)
		                           ->setCellValue('C' . $kolom, $pengguna->NamaKaryawan)
		                           ->setCellValue('D' . $kolom, $pengguna->NamaDept)
		                           ->setCellValue('E' . $kolom, date('d M y',strtotime($pengguna->TglPelatihan)))
		                           ->setCellValue('F' . $kolom, $pengguna->NamaMateri)
		                           ->setCellValue('G' . $kolom, $pengguna->Trainer)
		                           ->setCellValue('H' . $kolom, $pengguna->Lokasi)
		                           ->setCellValue('I' . $kolom, $pengguna->Pelapor)
		                           ->setCellValue('J' . $kolom, $pengguna->Pemeriksa)
		                           ->setCellValue('K' . $kolom, date('d M y',strtotime($pengguna->TglNow)));

		               $kolom++;
		               $nomor++;

		          }

		          $writer = new Xlsx($spreadsheet);

		          $nomor = date('his');

		          header('Content-Type: application/vnd.ms-excel');
			  header('Content-Disposition: attachment;filename="Laporan Training-"'.$nomor.'".xls');
			  header('Cache-Control: max-age=0');

			  $writer->save('php://output');
			}else if($submit == 'Search'){
				$data['period_awal'] = date('d-m-Y',strtotime($this->input->post('period_awal')));
				$data['period_akhir'] = date('d-m-Y',strtotime($this->input->post('period_akhir')));
				
				$data['dept'] 		= $this->m_dept->lihat_data();
				$data['training'] 	= $this->m_training->lihat_detail_all();
				$data['log'] 		= $this->m_log->lihat_pdf($period_awal,$period_akhir,$dept);
				$this->load->view('template/header');
				$this->load->view('log/index',$data);
				$this->load->view('template/footer');
			}
			else{
				redirect('Log');
			}

		}
	}
}

 ?>