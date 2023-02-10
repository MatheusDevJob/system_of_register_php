<?php

function permicao()
{
    $ci = get_instance();
    $logged_user = $ci->session->userdata('logged_user');
    // var_dump($logged_user);exit;
    if (!$logged_user) {
        $ci->session->set_flashdata("loga primerio");
        redirect('');
    }
    return $logged_user;
}

function permissao_login()
{
    $ci = get_instance();
    $logged_user = $ci->session->userdata('logged_user');
    if($logged_user){
        $ci->session->set_flashdata("Já está logado");
        redirect('contato/pesquisar');
    }
    return $logged_user;
}