<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Middleware {

    protected $CI;

    public function __construct($params) {
        $this->CI =& get_instance();
        if(!$this->CI->session->is_logged){
            $this->CI->session->set_flashdata([
                'error' => "Veuillez vous connecter avant d'accèder à cette page"
            ]);
            redirect('login/');
        } else {
            if($this->CI->session->group != $params['group']) {
                $this->CI->session->set_flashdata([
                    'error' => "Vous n'avez pas accès à cette page" 
                ]);
                redirect('/');
            }
        }
     }
}