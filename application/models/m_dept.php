<?php 

/**
 * 
 */
class m_dept extends CI_Model
{
	
	public function lihat_data()
	{
		$query = $this->db->query("SELECT * FROM m_department ORDER BY ID_Dept DESC");
		return $query;
	}

	public function simpan_data()
	{
		$data = array(
			'ID_Dept'		=> null,
			'NamaDept'		=> $this->input->post('nama')
			);

		$this->db->insert('m_department',$data);
	}

	public function get_data($id)
	{
		$query = $this->db->query("SELECT * FROM m_department WHERE ID_Dept = $id ");
		return $query;
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('ID_Dept',$id);
        $this->db->delete('m_department');
    }
}
 ?>