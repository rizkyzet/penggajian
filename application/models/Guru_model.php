<?php

class Guru_model extends CI_Model
{
    public function getGuru()
    {
        $this->db->select('*,guru.id as idnya_guru');
        $this->db->from('guru');
        $this->db->join('jabatan', 'jabatan.id=guru.id_jabatan');
        return $this->db->get()->result_array();
    }

    public function getOneGuruWhere($array)
    {
        $this->db->select('*,guru.id as idnya_guru');
        $this->db->from('guru');
        $this->db->join('jabatan', 'jabatan.id=guru.id_jabatan');
        $this->db->where($array);
        return $this->db->get()->row_array();
    }


    public function getGuruWhere($array)
    {
        $this->db->select('*,guru.id as idnya_guru');
        $this->db->from('guru');
        $this->db->join('jabatan', 'jabatan.id=guru.id_jabatan');
        $this->db->where($array);
        return $this->db->get()->result_array();
    }
}
