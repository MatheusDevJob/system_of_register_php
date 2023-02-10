<?php

class Login_model extends CI_Model
{
    public function login()
    {
        return;
    }

    public function confirma_login($usuario, $senha)
    {
        $this->db->where('usuario', $usuario);
        $this->db->where('senha', $senha);
        return $this->db->get('usuario')->result_array();
    }
}
