<?php

class Register extends CI_Controller {

    public function __construct() {
       parent::__construct();

       //form-validation en général pour repeupler les input dans index
       $this->load->library('form_validation');

        if($this->session->is_logged) {
            $this->session->set_flashdata([
                'error' => 'Vous êtes déjà connecté'
            ]);
            redirect('/');
        }
    }

    public function index() {
        $this->load->library('template');
        $this->template->view('layouts/template', 'users/register');
    }

    public function validation() {
        $this->load->model('users_model');

        $this->form_validation->set_rules('username', "Nom d'utilisateur",
            'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Mot de passe', 'required');
        $this->form_validation->set_rules(
            'passwordRepeat',
            'Confirmation de mot de passe',
            'required|matches[password]'
            );
        

        if ($this->form_validation->run() === false) {
            // Erreur à la validation
            $this->session->set_flashdata([
                'error' => validation_errors(),
            ]);
            $this->index();
        } else {
            
            $username = $this->input->post('username');
            $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

            $this->users_model->insert_user($username, $password);

            $this->session->set_flashdata([
                'success' => 'Vous êtes enregistré',
            ]);
            redirect('/');
        }
    }
}