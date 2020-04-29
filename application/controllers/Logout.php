<?php

class Logout extends CI_Controller {

    public function index() {
        $this->load->library('session');
        if($this->session->is_logged) {
            $this->session->set_userdata([
                'is_logged' => false,
                'username' => null,
                'group' => null,
            ]);
            $this->session->set_flashdata([
                'success' => "Vous avez été déconnecté"
            ]);
            redirect('/');
        }
        $this->session->set_flashdata([
            'error' => "Vous n'êtes pas connecté"
        ]);
        redirect('/');
    }
}