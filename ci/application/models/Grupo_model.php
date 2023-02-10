<?php

class Grupo_model extends CI_Model
{
    public function registra_grupo($grupos)
    {
        $this->db->set('descricao', $grupos);
        return $this->db->insert('grupo');
    }
    public function update_grupo_contato($grupo, $grupo_id)
    {
        array_map(function ($v1, $v2) {
            $this->db->set('grupo_id', $v1);
            $this->db->where('id', $v2);
            return $this->db->update('grupo_contato');
        }, $grupo, $grupo_id);
        
    }
    public function update_grupo($grupo, $grupo_id)
    {
        array_map(function ($v1, $v2) {
            $this->db->set('descricao', $v1);
            $this->db->where('id', $v2);
            return $this->db->update('grupo');
        }, $grupo, $grupo_id);
    }

    public function confirmar_grupo($id, $grupo)
    {
        $this->db->where('id', $id);
        $this->db->insert('grupo');
    }


    function adicionar_grupo($last_id, $grupo)
    {
        $this->db->set('contato_id', $last_id);
        $this->db->set('grupo_id', $grupo);
        return $this->db->insert('grupo_contato');
    }

    function apagar_grupo_contato($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('grupo_contato');
    }
    
    function apagar_grupo($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('grupo');
    }

    function filtra_grupo($busca)
    {
        $this->db->where('contato_id', $busca);
        return $this->db->get('grupo')->result_array();
    }

    public function lista_grupos()
    {
        return $this->db->get('grupo')->result_array();
    }
    public function pesquisa_grupo($dados)
    {
        $this->db->join('grupo_contato', 'grupo.id = grupo_contato.grupo_id');
        $this->db->where('grupo_contato.contato_id', $dados);
        return $this->db->get('grupo')->result_array();
    }
    public function pesquisa_grupo_pelo_grupo_id($dados)
    {
        $this->db->join('grupo_contato', 'grupo.id = grupo_contato.grupo_id');
        $this->db->where('grupo_contato.grupo_id', $dados);
        return $this->db->get('grupo')->row_array();
    }
}
