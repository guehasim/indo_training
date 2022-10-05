<?php 

/**
 * 
 */
class m_training extends CI_Model
{

	//================================= master training
	
	public function lihat_data()
	{
		$query = $this->db->query("SELECT
										m_training.ID_Training, 
										m_training.NamaTraining, 
										COUNT(detail_training.ID_Training) AS total
									FROM
										m_training
										LEFT JOIN
										detail_training
										ON 
											m_training.ID_Training = detail_training.ID_Training
									GROUP BY
										m_training.ID_Training, 
										m_training.NamaTraining
									ORDER BY
										m_training.ID_Training DESC");
		return $query;
	}

	public function simpan_data()
	{
		$data = array(
			'ID_Training'		=> null,
			'NamaTraining'		=> $this->input->post('nama')
			);

		$this->db->insert('m_training',$data);
	}

	public function get_data($id)
	{
		$query = $this->db->query("SELECT * FROM m_training WHERE ID_Training = $id ");
		return $query;
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('ID_Training',$id);
        $this->db->delete('m_training');
    }

    //==================================== detail training

    public function lihat_detail($id)
	{
		$query = $this->db->query("SELECT * FROM detail_training WHERE ID_Training = '$id' ORDER BY ID_DetailTraining DESC");
		return $query;
	}

	public function lihat_detail_all()
	{
		$query = $this->db->query("SELECT
										detail_training.ID_DetailTraining, 
										detail_training.ID_Training, 
										detail_training.NamaMateri, 
										detail_training.Trainer, 
										detail_training.Lokasi, 
										detail_training.ReportBy, 
										detail_training.Duration
									FROM
										m_training
										INNER JOIN
										detail_training
										ON 
											m_training.ID_Training = detail_training.ID_Training ORDER BY detail_training.ID_DetailTraining ASC");
		return $query;
	}

	public function simpan_detail()
	{
		$data = array(
			'ID_DetailTraining'		=> null,
			'ID_Training'			=> $this->input->post('id_training'),
			'NamaMateri' 			=> $this->input->post('nama'),
			'Trainer' 				=> $this->input->post('trainer'),
			'Lokasi' 				=> $this->input->post('lokasi'),
			'ReportBy' 				=> $this->input->post('report'),
			'Duration' 				=> $this->input->post('durasi')
			);

		$this->db->insert('detail_training',$data);
	}

	public function get_detail($id)
	{
		$query = $this->db->query("SELECT * FROM detail_training WHERE ID_DetailTraining = $id ");
		return $query;
	}

	public function hapus_detail($id)
    {
        $this->db->where('ID_DetailTraining',$id);
        $this->db->delete('detail_training');
    }
}
 ?>