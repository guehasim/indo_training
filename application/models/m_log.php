<?php 


class m_log extends CI_Model
{
	
	public function lihat_data()
	{
		$query = $this->db->query("SELECT
									training_record.ID_TrainingRecord, 
									training_record.TglPelatihan, 
									training_record.TglNow, 
									training_record.ID_DetailTraining, 
									training_record.ID_Karyawan, 
									training_record.Pelapor, 
									training_record.Pemeriksa, 
									m_karyawan.NikKaryawan, 
									m_karyawan.NamaKaryawan, 
									m_department.NamaDept, 
									detail_training.NamaMateri, 
									detail_training.Trainer, 
									detail_training.Lokasi
								FROM
									training_record
									LEFT JOIN
									detail_training
									ON 
										training_record.ID_DetailTraining = detail_training.ID_DetailTraining
									LEFT JOIN
									m_karyawan
									ON 
										training_record.ID_Karyawan = m_karyawan.ID_Karyawan
									INNER JOIN
									m_department
									ON 
										m_karyawan.ID_Dept = m_department.ID_Dept
								ORDER BY
									training_record.ID_TrainingRecord DESC");
		return $query;
	}

	public function lihat_pdf($period_awal,$period_akhir,$dept)
	{
		if ($period_awal != '' && $period_akhir != '' && $dept != '0') {
			$tampil = "WHERE training_record.TglPelatihan BETWEEN '$period_awal' AND '$period_akhir' AND m_karyawan.ID_Dept = '$dept' ";
		}else if($period_awal != '' && $period_akhir != '' && $dept == '0'){
			$tampil = "WHERE training_record.TglPelatihan BETWEEN '$period_awal' AND '$period_akhir'";
		}
		else{
			$tampil = "";
		}
		
		$query = $this->db->query("SELECT
									training_record.ID_TrainingRecord, 
									training_record.TglPelatihan, 
									training_record.TglNow, 
									training_record.ID_DetailTraining, 
									training_record.ID_Karyawan, 
									training_record.Pelapor, 
									training_record.Pemeriksa, 
									m_karyawan.NikKaryawan, 
									m_karyawan.NamaKaryawan, 
									m_department.NamaDept, 
									detail_training.NamaMateri, 
									detail_training.Trainer, 
									detail_training.Lokasi
								FROM
									training_record
									LEFT JOIN
									detail_training
									ON 
										training_record.ID_DetailTraining = detail_training.ID_DetailTraining
									LEFT JOIN
									m_karyawan
									ON 
										training_record.ID_Karyawan = m_karyawan.ID_Karyawan
									INNER JOIN
									m_department
									ON 
										m_karyawan.ID_Dept = m_department.ID_Dept
								$tampil
								ORDER BY
									training_record.ID_TrainingRecord DESC
									");
		return $query;
	}

	public function simpan_data()
	{
		$data = array(
			'ID_TrainingRecord'		=> null,
			'TglPelatihan'			=> date('Y-m-d',strtotime($this->input->post('Tgl'))),
			'TglNow' 				=> date('Y-m-d'),
			'ID_DetailTraining' 	=> $this->input->post('id_detail'),
			'ID_Karyawan' 			=> $this->input->post('id_karyawan'),
			'Pelapor' 				=> $this->input->post('pelapor'),
			'Pemeriksa' 			=> $this->input->post('pemeriksa')
			);

		$this->db->insert('training_record',$data);
	}

	public function get_data($id)
	{
		$query = $this->db->query("SELECT * FROM training_record WHERE ID_TrainingRecord = $id ");
		return $query;
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('ID_TrainingRecord',$id);
        $this->db->delete('training_record');
    }
}
 ?>