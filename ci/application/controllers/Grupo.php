<?php

class Grupo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('grupo_model');
    }

    public function registrar_grupo()
    {
        permicao();
        $dados['title'] = 'Registrar Grupos';
        $dados['pesquisa'] = 'nav-link';
        $dados['contato'] = 'nav-link';
        $dados['grupo'] = 'nav-link active';
        $this->load->view('templates/header', $dados);
        $this->load->view('templates/nav');
        $this->load->view('pages/grupos');
        $this->load->view('templates/footer');
    }
    public function registra_grupo()
    {
        $dados = $this->input->post();
        foreach ($dados['novo_grupo'] as $grupos) {
            $result = $this->grupo_model->registra_grupo($grupos);
        }
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function adicionar_grupo()
    {
        $dados = $this->input->post();
        $array = array(
            'contato_id' => $dados['id'],
            'grupo' => $dados['grupo']
        );
        $this->grupo_model->adicionar_grupo($array);
    }

    public function insert_grupo()
    {
        $dados = $this->input->post();
        $id = $dados['id'];
        $grupo = $dados['grupo'];
        $this->grupo_model->adicionar_grupo($id, $grupo);
    }

    public function apagar_grupo_contato()
    {
        $id = $this->input->post();
        $this->grupo_model->apagar_grupo_contato($id['id']);
    }

    public function confirmar_grupo_contato()
    {
        $dados = $this->input->post();
        $this->grupo_model->update_grupo_contato($dados['grupos'], $dados['grupos_id']);
    }

    public function lista_grupos()
    {
        $dados = $this->grupo_model->lista_grupos();
        echo json_encode($dados, JSON_UNESCAPED_UNICODE);
    }

    public function apagar_grupo()
    {
        $dados = $this->input->post();
        $grupos = $this->grupo_model->pesquisa_grupo_pelo_grupo_id($dados['id']);
        if (empty($grupos)) {
            $result = $this->grupo_model->apagar_grupo($dados['id']);
        }
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function confirma_grupo()
    {
        $dados = $this->input->post();
        $this->grupo_model->update_grupo($dados['grupos'], $dados['grupos_id']);
        // array_map(function ($v1, $v2){
        //     $this->grupo_model->();
        // }, $dados['grupos'], $dados['grupos_id']);
    }
}
