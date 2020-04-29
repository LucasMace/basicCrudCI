<?php

class News extends CI_Controller {
    public function __construct() {
        parent::__construct();
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
        $this->load->library('middleware', [
            'group' => 'writer'
        ]);
        $this->load->model('news_model');
        $this->load->library('template');
        
        $data['news_item'] = $this->news_model->get_news($id);

        if (empty($data)) {
            show_404();
        }
        $data['action'] = "news/update";
        $data['page_title'] = "Edition article";
        $this->template->view('layouts/template', 'news/form', $data);
    }

    public function create() {
        $this->load->library('middleware', [
            'group' => 'writer'
        ]);

        $this->load->library('template');
        $data['action'] = "news/store";
        $data['page_title'] = "Création article";
        $this->template->view('layouts/template', 'news/form', $data);
    }

    public function store() {
        $this->load->model('news_model');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Titre', 'required');
        $this->form_validation->set_rules('text', 'Texte', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata([
                'error' => validation_errors()
            ]);
            redirect('news/create');
        } else {
            // redirige à la page d'accueil avec message de réussite
            $slug = url_title($this->input->post('title'), 'dash', TRUE);

            $data = [
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'text' => $this->input->post('text'),
            ];

            $this->news_model->insert_news_article($data);
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
            $this->session->set_flashdata([
                'error' => validation_errors()
            ]);
            redirect('/news/edit/' . $id);
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'text' => $this->input->post('text'),
            ];

            $this->news_model->update_news_item($id, $data);
            $this->session->set_flashdata([
                'success' => 'Votre article a été modifié avec succès'
            ]);
            redirect('/news/show/' . $id);
        }
    }

    public function delete($id = null) {
        
        $this->load->library('middleware', [
            'group' => 'writer'
        ]);
        
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