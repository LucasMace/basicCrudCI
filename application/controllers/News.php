<?php

class News extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('news_model');
        $this->load->helper('url_helper');
    }
    public function index() {
        $data['news'] = $this->news_model->get_news();

        //on charge le fragment de la page propre à la méthode avant de l'intégrer au layout
        $layout['content'] = $this->load->view('news/index', $data, true);
        $this->load->view('layouts/template', $layout);
    }

    public function show($id = null) {
        $data = $this->news_model->get_news($id);

        if (empty($data)) {
            show_404();
        }
        $layout['content'] = $this->load->view('news/show', ['news_item' => $data], true); 
        $this->load->view('layouts/template', $layout);  
    }

    public function edit($id = null) {
        $this->load->helper('form');
        $data = $this->news_model->get_news($id);

        if (empty($data)) {
            show_404();
        }
        $layout['content'] = $this->load->view('news/edit', ['news_item' => $data], true);
        $this->load->view('layouts/template', $layout); 
    }

    public function create() {
        $this->load->helper('form');
        $layout['content'] = $this->load->view('news/create', null, true);
        $this->load->view('layouts/template', $layout);  
    }

    public function store() {
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

    public function update($id = null)
    {
        if ($id === null) {
            show_404();
        }
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
            $this->news_model->delete_news_item($id);
            $this->session->set_flashdata([
                'success' => 'Votre article a été supprimé avec succès'
            ]);
            redirect("/");
        }
    }
}