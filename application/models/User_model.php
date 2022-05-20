<?php

class User_model extends CI_Model
{
    public function getUserByNip($username)
    {
        return $this->db->get_where('user', ['username' => $username])->row_array();
    }

    public function getUserByUsername($username)
    {
        return $this->db->get_where('user', ['username' => $username])->row_array();
    }


    public function getUserByLogin()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }
}
