<?php

class Absen_model extends CI_Model
{
    public function getAbsenJoinGuru()
    {
        $this->db->select('*,absen.id as idnya_absen');
        $this->db->from('absen');
        $this->db->join('guru', 'absen.id_guru=guru.id');
        return $this->db->get()->result_array();
    }

    public function getAbsenJoinGuruWhere($where)
    {
        $this->db->select('*,absen.id as idnya_absen');
        $this->db->from('absen');
        $this->db->join('guru', 'absen.id_guru=guru.id');
        $this->db->where($where);
        return $this->db->get()->row_array();
    }

    public function getAllAbsenJoinGuruWhere($where)
    {
        $this->db->select('*,absen.id as idnya_absen');
        $this->db->from('absen');
        $this->db->join('guru', 'absen.id_guru=guru.id');
        $this->db->where($where);
        return $this->db->get()->result_array();
    }
}
