<?php

class Contato_model extends CI_Model
{
    function insert_contato($contato)
    {
        $this->db->set('nome', $contato);
        $this->db->insert('contato');
        return $this->db->insert_id();
    }

    public function pesquisa($busca, $inicio, $maximo)
    {
        $this->db->join('email', 'contato.id = email.contato_id');
        $this->db->join('telefone', 'contato.id = telefone.contato_id');
        $this->db->join('grupo_contato', 'contato.id = grupo_contato.contato_id');
        $this->db->join('grupo', 'grupo.id = grupo_contato.grupo_id');
        $this->db->like('nome', $busca);
        $this->db->group_by('contato.id');
        $this->db->limit($maximo, $inicio);
        return $this->db->get('contato')->result_array();
    }

    public function count_tabela_clientes()
    {
        return $this->db->count_all_results('contato');
    }

    public function pesquisa_nome($busca)
    {
        $this->db->where('id', $busca);
        return $this->db->get('contato')->result_array();
    }

    public function pesquisa_email($busca)
    {
        $this->db->where('contato_id', $busca);
        return $this->db->get('email')->result_array();
    }

    public function pesquisa_telefone($busca)
    {
        $this->db->where('contato_id', $busca);
        return $this->db->get('telefone')->result_array();
    }

    public function pesquisa_grupo($busca)
    {
        $this->db->where('contato_id', $busca);
        return $this->db->get('grupo')->result_array();
    }

    public function update_contato($name, $id)
    {
        $this->db->set('nome', $name);
        $this->db->where('id', $id);
        return $this->db->update('contato');
    }

    // telefone area
    public function update_telefone($telefone, $id)
    {
        array_map(function ($v1, $v2) {
            $this->db->set('telefone', $v1);
            $this->db->where('id', $v2);
            return $this->db->update('telefone');
        }, $telefone, $id);
    }

    function apagar_telefone($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('telefone');
    }

    function adicionar_telefone($last_id, $telefone)
    {
        $this->db->set('contato_id', $last_id);
        $this->db->set('telefone', $telefone);
        return $this->db->insert('telefone');
    }

    function insert_telefone($dados)
    {
        $this->db->insert('telefone', $dados);
    }

    function filtra_telefone($busca)
    {
        $this->db->where('contato_id', $busca);
        return $this->db->get('telefone')->result_array();
    }

    // email area
    function registra_grupo($email)
    {
        foreach ($email as $dados) {
            $this->db->set('email', $dados);
            $this->db->insert('email');
        }
    }

    public function adicionar_email($last_id, $email)
    {
        $this->db->set('contato_id', $last_id);
        $this->db->set('email', $email);
        return $this->db->insert('email');
    }

    function apagar_email($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('email');
    }

    function filtra_email($busca)
    {
        $this->db->where('contato_id', $busca);
        return $this->db->get('email')->result_array();
    }
    public function update_email($email, $id)
    {
        array_map(function ($v1, $v2) {
            $this->db->set('email', $v1);
            $this->db->where('id', $v2);
            return $this->db->update('email');
        }, $email, $id);
        // foreach ($email as $value) {
        // }
    }
}
