<?php 

/**
 * 
 */
class m_position extends CI_Model
{
	
	public function lihat_data()
	{
		$query = $this->db->query("SELECT * FROM m_position ORDER BY ID_Position DESC");
		return $query;
	}

	public function simpan_data()
	{
		$data = array(
			'ID_Position'	=> null,
			'NamaPosition'	=> $this->input->post('nama')
			);

		$this->db->insert('m_position',$data);
	}

	public function get_data($id)
	{
		$query = $this->db->query("SELECT * FROM m_position WHERE ID_Position = $id ");
		return $query;
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('ID_Position',$id);
        $this->db->delete('m_position');
    }
}
 ?>