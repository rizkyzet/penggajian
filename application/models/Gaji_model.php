<?php

class Gaji_model extends CI_Model
{
    public function getGajiJoinGuru()
    {
        $this->db->select('*,gaji.id as idnya_gaji');
        $this->db->from('gaji');
        $this->db->join('guru', 'guru.id=gaji.id_guru');
        return $this->db->get()->result_array();
    }

    public function getGajiJoinGuruWhere($where)
    {
        $this->db->select('*');
        $this->db->from('gaji');
        $this->db->join('guru', 'guru.id=gaji.id_guru');
        $this->db->where($where);
        return $this->db->get()->result_array();
    }

    public function getGajiHeader($id)
    {
        return $this->db->get_where('gaji', ['id' => $id])->row_array();
    }

    public function getAllGajiDetail($id)
    {
        return $this->db->get_where('detail_gaji', ['id_gaji' => $id])->result_array();
    }

    public function getGajiHeaderWhere($id)
    {
        return $this->db->get_where('gaji', ['id' => $id])->row_array();
    }
}
