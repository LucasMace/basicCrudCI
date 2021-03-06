<?php

class News_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    /**
     * permet de récuperer l'ensemble des articles ou un seul si un id est spécifié
     */
    public function get_news($id = false) {
        if($id === false) {
            $query = $this->db->get('news');
            return $query->result_array();
        }
        $query = $this->db->get_where('news', ['id' => $id]);
        return $query->row_array();
    }

    /**
     * Modifie un article
     * @param
     * int $id article
     * 
     * utilise les informations des input post pour la modif
     */
    public function update_news_item($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('news', $data);
    }

    /**
     * Insertion d'un article
     */
    public function insert_news_article($data) {
        return $this->db->insert('news', $data);
    }
    /**
     * Delete à partir de l'id
     */
    public function delete_news_item($id) {
        $this->db->where('id', $id);
        $this->db->delete('news');
    }
}