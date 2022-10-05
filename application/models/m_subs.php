<?php 

/**
 * 
 */
class m_subs extends CI_Model
{
	
	public function lihat_data()
	{
		$query = $this->db->query("SELECT * FROM m_subsection ORDER BY ID_Subs DESC");
		return $query;
	}

	public function simpan_data()
	{
		$data = array(
			'ID_subs'		=> null,
			'NamaSubs'		=> $this->input->post('nama')
			);

		$this->db->insert('m_subsection',$data);
	}

	public function get_data($id)
	{
		$query = $this->db->query("SELECT * FROM m_subsection WHERE ID_Subs = $id ");
		return $query;
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('ID_Subs',$id);
        $this->db->delete('m_subsection');
    }
}
 ?>