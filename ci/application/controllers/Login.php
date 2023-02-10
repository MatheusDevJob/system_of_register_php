<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('login_model');
    }

    public function index()
    {
        permissao_login();
        $dados['title'] = 'Login';
        $dados['pesquisa'] = 'nav-link';
        $dados['contato'] = 'nav-link';
        $dados['grupo'] = 'nav-link';
        $this->load->view('templates/header', $dados);
        $this->load->view('pages/login', $dados);
        $this->load->view('templates/footer', $dados);
    }

    public function login()
    {
        $dados  = $this->input->post();
        $usuario = $dados['usuario'];
        $senha = md5($dados['senha']);
        $logado = $this->login_model->confirma_login($usuario, $senha);
        if ($logado) {
            $this->session->set_userdata('logged_user', $logado);
            redirect('contato/pesquisar');
        } else {
            $this->session->set_flashdata("retorno","Usuario ou Senha incorreto(os)");
            redirect('');
            // echo json_encode(false, JSON_UNESCAPED_UNICODE);
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_user');
        redirect('');
    }
}
