<?php

class Contato extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('contato_model');
        $this->load->model('grupo_model');
        $this->load->library('session');
        $this->load->library('pagination');
        permicao();
    }

    function registrar_nome()
    {
        $dados['title'] = 'Novo Registro';
        $dados['pesquisa'] = 'nav-link';
        $dados['contato'] = 'nav-link active';
        $dados['grupo'] = 'nav-link';
        $this->load->view('templates/header', $dados);
        $this->load->view('templates/nav');
        $this->load->view('pages/registrar_contato');
        $this->load->view('templates/footer');
    }

    function pesquisar()
    {
        $dados['title'] = 'Pesquisa Contato';
        $dados['pesquisa'] = 'nav-link active';
        $dados['contato'] = 'nav-link';
        $dados['grupo'] = 'nav-link';
        $this->load->view('templates/header', $dados);
        $this->load->view('templates/nav');
        $this->load->view('pages/pesquisa_banco_dados', $dados);
        $this->load->view('templates/footer');
    }

    public function store()
    {

        $dados = $this->input->post();
        if (!empty($dados['contato']) && !empty($dados['email']) && !empty($dados['telefone']) && !empty($dados['grupo'])) {
            $contato = $dados['contato'];
            $email = $dados['email'];
            $grupo = $dados['grupo'];
            $tel = $dados['telefone'];
            $last_id = $this->contato_model->insert_contato($contato);
            $return = $this->grupo_model->adicionar_grupo($last_id, $grupo);
            foreach ($email as $value) {
                $return = $this->contato_model->adicionar_email($last_id, $value);
            }
            foreach ($tel as $value) {
                $return = $this->contato_model->adicionar_telefone($last_id, $value);
            }
        }
        echo json_encode($return, JSON_UNESCAPED_UNICODE);
    }

    public function novos_registros()
    {
        $dados = $this->input->post();
        foreach ($dados['email'] as $value) {
            $return = $this->contato_model->adicionar_email($dados['id'], $value);
        }
        foreach ($dados['telefone'] as $value) {
            $return = $this->contato_model->adicionar_telefone($dados['id'], $value);
        }
        echo json_encode($return, JSON_UNESCAPED_UNICODE);
    }

    public function editar($id)
    {
        $result_id['id'] = $id;
        $result_id['title'] = 'Editar Contato';
        $result_id['pesquisa'] = 'nav-link';
        $result_id['contato'] = 'nav-link';
        $result_id['grupo'] = 'nav-link';
        $this->load->view('templates/header', $result_id);
        $this->load->view('templates/nav');
        $this->load->view('pages/editar', $result_id);
        $this->load->view('templates/footer');
    }

    // atualiza contato
    public function confirmar()
    {
        $dados = $this->input->post();
        $data = true;
        if (!empty($dados)) {
            $return = $this->contato_model->update_contato($dados['nome'], $dados['nome_id']);
            $return = $this->contato_model->update_email($dados['email'], $dados['email_id']);
            $return = $this->contato_model->update_telefone($dados['telefone'], $dados['telefone_id']);
        }
        echo json_encode($return, JSON_UNESCAPED_UNICODE);
    }

    public function pesquisa()
    {
        $post = $this->input->post('nome');
        $inicio = $this->input->post('inicio');
        $maximo = 10;
        $navegacao['anterior'] = null;
        $navegacao['proximo'] = null;
        $numPaginas = null;

        $registros = $this->contato_model->pesquisa($post, $inicio, $maximo);
        $total = $this->contato_model->count_tabela_clientes();

        if (!empty($total)) {
            $numPaginas = $total / $maximo;
            if ($numPaginas > 5) {

                if ($inicio <= 3 * $maximo) {
                    $numDaPagina[0] = 0;
                    $numDaPagina[1] = $maximo;
                    $numDaPagina[2] = 2 * $maximo;
                    $numDaPagina[3] = 3 * $maximo;
                    $numDaPagina[4] = 4 * $maximo;
                } else {
                    $numDaPagina[0] = $inicio - 2 * $maximo;
                    $numDaPagina[1] = $inicio - $maximo;
                    $numDaPagina[2] = $inicio;
                    $numDaPagina[3] = $inicio + $maximo;
                    $numDaPagina[4] = $inicio + 2 * $maximo;
                }
            } else {
                for ($i = 0; $i < $numPaginas; $i++) {
                    $numDaPagina[$i] = $i * $maximo;
                }
            }
        } else {
            $numDaPagina[0] = $maximo;
        }

        if ($inicio <= 3 * $maximo) {
            $indexDaPagina = 1;
        } else {
            $indexDaPagina = ($inicio / $maximo) - 1;
        }

        if ($total < $maximo) {
            $navegacao['anterior'] = null;
            $navegacao['proximo'] = null;
        } else if ($inicio == 0) {
            $navegacao['anterior'] = null;
            $navegacao['proximo'] = $inicio + $maximo;
        } else if ($inicio >= $total) {
            $navegacao['anterior'] = $inicio - $maximo;
            $navegacao['proximo'] = null;
        } else if (($inicio > 0) && ($inicio < $total)) {
            $navegacao['anterior'] = $inicio - $maximo;
            $navegacao['proximo'] = $inicio + $maximo;
        }
        $inicio == null ? $inicio = 0 : '';
        echo json_encode(array('total' => $total, 'registros' => $registros, 'navegacao' => $navegacao, 'numPaginas' => $numPaginas, 'numDaPagina' => $numDaPagina, 'inicio' => $inicio, 'indexDaPagina' => $indexDaPagina), JSON_UNESCAPED_UNICODE);
    }

    public function pesquisa_id()
    {
        $post = $this->input->post();
        $data['nome'] = $this->contato_model->pesquisa_nome($post['id']);
        $data['email'] = $this->contato_model->pesquisa_email($post['id']);
        $data['telefone'] = $this->contato_model->pesquisa_telefone($post['id']);
        $data['grupo'] = $this->grupo_model->pesquisa_grupo($post['id']);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function apagar_email()
    {
        $id = $this->input->post();
        $this->contato_model->apagar_email($id['id']);
    }

    public function apagar_telefone()
    {
        $id = $this->input->post();
        $this->contato_model->apagar_telefone($id['id']);
    }
}
