<?php 

/**
 * 
 */
class Karyawan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->model('m_karyawan');
		$this->load->model('m_dept');
		$this->load->model('m_subs');
		$this->load->model('m_position');
		$this->load->model('m_education');
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
			$data['dept'] 		= $this->m_dept->lihat_data();
			$data['sub'] 		= $this->m_subs->lihat_data();
			$data['pos'] 		= $this->m_position->lihat_data();
			$data['edu'] 		= $this->m_education->lihat_data();
			$data['karyawan'] 	= $this->m_karyawan->lihat_data();
			$this->load->view('template/header');
			$this->load->view('Employee/index',$data);
			$this->load->view('template/footer');
		}		
	}
	public function simpan()
	{
		$nik = $this->input->post('nik');

		$this->db->where('NikKaryawan', $nik);
		$query = $this->db->get('m_karyawan');

		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('msg',
						'<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                ID Karyawan Ini Sudah Ada Sudah Ada !!
						</div>');
			redirect('Karyawan');
		}else{
			$config['upload_path'] = 'assets/upload/images/'; //path folder
	        $config['allowed_types'] = 'jpg|jpeg|png'; //type yang dapat diakses bisa anda sesuaikan
	        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload

	        $this->upload->initialize($config);
	        if(!empty($_FILES['image']['name'])){
	 
	            if ($this->upload->do_upload('image')){
	            	$gbr = $this->upload->data();
	                //Compress Image
	                $config['image_library']='gd2';
	                $config['source_image']='assets/upload/images/'.$gbr['file_name'];
	                $config['create_thumb']= FALSE;
	                $config['maintain_ratio']= FALSE;
	                $config['quality']= '50%';
	                $config['width']= 300;
	                $config['height']= 400;
	                $config['new_image']= 'assets/upload/images/'.$gbr['file_name'];
	                $this->load->library('image_lib', $config);
	                $this->image_lib->resize();

	                $gambar=$gbr['file_name'];
	                // echo "Image berhasil diupload";

	                if (isset($_POST)) {
	                	$this->m_karyawan->simpan_data($gambar);
						$this->session->set_flashdata('msg',
									'<div class="alert alert-success alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					                                Berhasil Menyimpan
									</div>');
						redirect('Karyawan');

	            }else{
	            	$this->session->set_flashdata('msg',
							'<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                                Gagal Dalam upload File!!
							</div>');
	            	redirect('Karyawan');
	            }
	                      
	        }else{

	        	$this->session->set_flashdata('msg',
							'<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                                Image Kualitasnya terlalu besar
							</div>');
	            	redirect('Karyawan');
	        	}
			
			}else{

				$gambar = null;

				$this->m_karyawan->simpan_data($gambar);
						$this->session->set_flashdata('msg',
									'<div class="alert alert-success alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					                                Berhasil Menyimpan
									</div>');
						redirect('Karyawan');
			}
		}		
	}

	public function update()
	{
		$config['upload_path'] = 'assets/upload/images/'; //path folder
	        $config['allowed_types'] = 'jpg|jpeg|png'; //type yang dapat diakses bisa anda sesuaikan
	        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload

	        $this->upload->initialize($config);
	        if(!empty($_FILES['image']['name'])){
	 
	            if ($this->upload->do_upload('image')){
	            	$gbr = $this->upload->data();
	                //Compress Image
	                $config['image_library']='gd2';
	                $config['source_image']='assets/upload/images/'.$gbr['file_name'];
	                $config['create_thumb']= FALSE;
	                $config['maintain_ratio']= FALSE;
	                $config['quality']= '50%';
	                $config['width']= 300;
	                $config['height']= 400;
	                $config['new_image']= 'assets/upload/images/'.$gbr['file_name'];
	                $this->load->library('image_lib', $config);
	                $this->image_lib->resize();

	                $gambar=$gbr['file_name'];
	                // echo "Image berhasil diupload";

	                $data = array(
						'NikKaryawan'		=> $this->input->post('nik'),
						'NamaKaryawan' 		=> $this->input->post('nama'),
						'ID_Dept'			=> $this->input->post('dept'),
						'ID_Subs' 			=> $this->input->post('subs'),
						'ID_Position' 		=> $this->input->post('position'),
						'TglKerja' 			=> date('Y-m-d',strtotime($this->input->post('tgl'))),
						'ID_Education'  	=> $this->input->post('edu'),
						'ImageKaryawan' 	=> $gambar
						);

					$where = array(
						'ID_Karyawan' 		=> $this->input->post('id')
						);

					$this->m_karyawan->update_data($where,$data,'m_karyawan');

					$this->session->set_flashdata('msg',
							'<div class="alert alert-info alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                                Berhasil Mengubah
							</div>');
					redirect('Karyawan');
	                      
	        }else{

	        	$this->session->set_flashdata('msg',
							'<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                                Image Kualitasnya terlalu besar
							</div>');
	            	redirect('Karyawan');
	        	}
			
			}else{

				$data = array(
					'NikKaryawan'		=> $this->input->post('nik'),
					'NamaKaryawan' 		=> $this->input->post('nama'),
					'ID_Dept'			=> $this->input->post('dept'),
					'ID_Subs' 			=> $this->input->post('subs'),
					'ID_Position' 		=> $this->input->post('position'),
					'TglKerja' 			=> date('Y-m-d',strtotime($this->input->post('tgl'))),
					'ID_Education'  	=> $this->input->post('edu')
					);

				$where = array(
					'ID_Karyawan' 		=> $this->input->post('id')
					);

				$this->m_karyawan->update_data($where,$data,'m_karyawan');

				$this->session->set_flashdata('msg',
						'<div class="alert alert-info alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Berhasil Mengubah
						</div>');
				redirect('Karyawan');
			}

		//======================================================================================

		
	}

	public function delete()
	{
		$id = $this->input->post('id');
        $this->m_karyawan->hapus_data($id);

        $this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
				</div>');
        redirect('Karyawan');
	}
}
 ?>