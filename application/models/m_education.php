<?php 

/**
 * 
 */
class m_education extends CI_Model
{
	
	public function lihat_data()
	{
		$query = $this->db->query("SELECT * FROM m_education ORDER BY ID_Education DESC");
		return $query;
	}

	public function simpan_data()
	{
		$data = array(
			'ID_Education'		=> null,
			'NamaEducation'		=> $this->input->post('nama')
			);

		$this->db->insert('m_education',$data);
	}

	public function get_data($id)
	{
		$query = $this->db->query("SELECT * FROM m_education WHERE ID_Education = $id ");
		return $query;
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('ID_Education',$id);
        $this->db->delete('m_education');
    }
}
 ?>