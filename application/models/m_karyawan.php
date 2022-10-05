<?php 

/**
 * 
 */
class m_karyawan extends CI_Model
{
	
	public function lihat_data()
	{
		$query = $this->db->query("SELECT
									m_karyawan.ID_Karyawan, 
									m_karyawan.NikKaryawan, 
									m_karyawan.NamaKaryawan, 
									m_karyawan.ID_Dept, 
									m_karyawan.ID_Subs, 
									m_karyawan.ID_Position, 
									m_karyawan.TglKerja, 
									m_karyawan.ID_Education, 
									m_karyawan.ImageKaryawan, 
									m_department.NamaDept, 
									m_subsection.NamaSubs, 
									m_position.NamaPosition, 
									m_education.NamaEducation
								FROM
									m_karyawan
									LEFT JOIN
									m_department
									ON 
										m_karyawan.ID_Dept = m_department.ID_Dept
									LEFT JOIN
									m_subsection
									ON 
										m_karyawan.ID_Subs = m_subsection.ID_Subs
									LEFT JOIN
									m_position
									ON 
										m_karyawan.ID_Position = m_position.ID_Position
									LEFT JOIN
									m_education
									ON 
										m_karyawan.ID_Education = m_education.ID_Education
								ORDER BY
									m_karyawan.ID_Karyawan DESC");
		return $query;
	}

	public function simpan_data($gambar)
	{
		$data = array(
			'ID_Karyawan'		=> null,
			'NikKaryawan'		=> $this->input->post('nik'),
			'NamaKaryawan' 		=> $this->input->post('nama'),
			'ID_Dept'			=> $this->input->post('dept'),
			'ID_Subs' 			=> $this->input->post('subs'),
			'ID_Position' 		=> $this->input->post('position'),
			'TglKerja' 			=> $this->input->post('tgl'),
			'ID_Education'  	=> $this->input->post('edu'),
			'ImageKaryawan' 	=> $gambar
			);

		$this->db->insert('m_karyawan',$data);
	}

	public function get_data($id)
	{
		$query = $this->db->query("SELECT * FROM m_karyawan WHERE ID_Karyawan = $id ");
		return $query;
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('ID_Karyawan',$id);
        $this->db->delete('m_karyawan');
    }
}
 ?>