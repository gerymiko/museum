<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Ccategory extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['mcategory/mod_category']);
        }

        public function category($id_menu){
            $id_menu = $this->my_encryption->encrypt_decrypt('decrypt',$id_menu);
            $data = array(
                'css_script' => 'pages/ext/header',
                'js_script'  => 'pages/ext/footer',
                'content'    => 'pages/pcategory/vcategory',
                'category'   => $this->mod_category->category($id_menu)
            );
            $this->load->view('pages/pindex/index', $data);
        }
    }
?>