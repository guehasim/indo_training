<?php 


class m_checker extends CI_Model
{
	
	public function lihat_data()
	{
		$query = $this->db->query("SELECT * FROM m_checker ORDER BY ID_Checker DESC");
		return $query;
	}

	public function simpan_data()
	{
		$data = array(
			'ID_Checker'		=> null,
			'NamaChecker'		=> $this->input->post('nama')
			);

		$this->db->insert('m_checker',$data);
	}

	public function get_data($id)
	{
		$query = $this->db->query("SELECT * FROM m_checker WHERE ID_Checker = $id ");
		return $query;
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('ID_Checker',$id);
        $this->db->delete('m_checker');
    }
}
 ?>