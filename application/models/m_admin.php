<?php 


class m_admin extends CI_Model
{
	
	public function lihat_data()
	{
		$query = $this->db->query("SELECT * FROM m_user ORDER BY ID_user DESC");
		return $query;
	}

	public function simpan_data()
	{
		$data = array(
			'ID_user'		=> null,
			'NamaUser'		=> $this->input->post('nama'),
			'Username'		=> $this->input->post('user'),
			'PassUser'		=> sha1(md5($this->input->post('pass')))
			);

		$this->db->insert('m_user',$data);
	}

	public function get_data($id)
	{
		$query = $this->db->query("SELECT * FROM m_user WHERE ID_user = $id ");
		return $query;
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('ID_user',$id);
        $this->db->delete('m_user');
    }
}
 ?>