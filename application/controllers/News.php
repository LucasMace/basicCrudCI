<?php

class News extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }
    public function index() {
        $this->load->library('template');
        $this->load->model('news_model');
        $data['news'] = $this->news_model->get_news();
        $this->template->view('layouts/template', 'news/index', $data);
    }

    public function show($id = null) {
        $this->load->model('news_model');
        $this->load->library('template');
        $data['news_item'] = $this->news_model->get_news($id);

        if (empty($data)) {
            show_404();
        }
        $this->template->view('layouts/template', 'news/show', $data);
    }

    public function edit($id = null) {
        $this->load->model('news_model');
        $this->load->library('template');
        $this->load->helper('form');
        $data['news_item'] = $this->news_model->get_news($id);

        if (empty($data)) {
            show_404();
        }
        $data['action'] = "news/update";
        $data['page_title'] = "Edition article";
        $this->template->view('layouts/template', 'news/form', $data);
    }

    public function create() {
        $this->load->library('template');
        $this->load->helper('form');
        $data['action'] = "news/store";
        $data['page_title'] = "Création article";
        $this->template->view('layouts/template', 'news/form', $data);
    }

    public function store() {
        $this->load->model('news_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Titre', 'required');
        $this->form_validation->set_rules('text', 'Texte', 'required');

        if ($this->form_validation->run() === false) {
            // Erreur à la validation
            redirect('news/create');
        } else {
            // redirige à la page d'accueil avec message de réussite
            $this->news_model->set_news();
            $this->session->set_flashdata([
                'success' => 'Votre article a été créer avec succès'
            ]);
            redirect('/');
        }
    }

    public function update() {
        $id = $this->input->post('id');
        if ($id === null) {
            show_404();
        }
        $this->load->model('news_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Titre', 'required');
        $this->form_validation->set_rules('text', 'Texte', 'required');

        if ($this->form_validation->run() === false) {
            //erreur à la valid
            redirect('/news/edit/' . $id);
        } else {
            $this->news_model->update_news_item($id);
            $this->session->set_flashdata([
                'success' => 'Votre article a été modifié avec succès'
            ]);
            redirect('/news/show/' . $id);
        }
    }

    public function delete($id = null) {
        if($id === NULL) {
            show_404();
        } else {
            $this->load->model('news_model');
            $this->news_model->delete_news_item($id);
            $this->session->set_flashdata([
                'success' => 'Votre article a été supprimé avec succès'
            ]);
            redirect("/");
        }
    }
}