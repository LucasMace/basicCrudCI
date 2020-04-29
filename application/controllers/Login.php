<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if($this->session->is_logged) {
            $this->session->set_flashdata([
                'error' => 'Vous êtes déjà connecté'
            ]);
            redirect('/');
        }
    }

    public function index() {
        $this->load->library('template');
        $this->template->view('layouts/template', 'users/login');
    }

    public function validation() {
        $this->load->model('users_model');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', "Nom d'utilisateur", 'required');
        $this->form_validation->set_rules('password', 'Mot de passe', 'required');

        if ($this->form_validation->run() === false) {
            // Erreur à la validation
            $this->session->set_flashdata([
                'error' => validation_errors(),
            ]);
            redirect('login/');
        } else {
            // redirige à la page d'accueil avec message de réussite
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->users_model->try_login($username, $password);
            if(is_null($user)) {
                $this->session->set_flashdata([
                    'error' => "Combinaison nom d'utilisateur / mot de passe incorrect"
                ]);
                $this->index();
                return;
            }
            $this->session->set_flashdata([
                'success' => 'Vous êtes connecté',
            ]);
            $this->session->set_userdata([
                'is_logged' => true,
                'username' => $user->username,
                'group' => $user->group,
            ]);
            redirect('/');
        }
    }
}