<?php

class Users_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * retourne un tableau contenant toute les info users si la combinaison username/password est correct
     * null sinon
     */
    public function try_login($username, $password) {
        $query = $this->db->get_where('users', [
            'username' => $username,
        ]);
        $row = $query->row();
        if(isset($row)){
            return password_verify($password, $row->password) ? $row : null;
        }
        return null;
    }

    /**
     * @param
     * string $username
     * string $password
     */
    public function insert_user($username, $password) {
        return $this->db->insert('users', [
            'username' => $username,
            'password' => $password,
        ]);
    }

}