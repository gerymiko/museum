<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Ccategory extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['mcategory/mod_category']);
        }

        public function category_list($id_alumni){
            $id_alumni = $this->my_encryption->encrypt_decrypt('decrypt',$id_alumni);
            $data = array(
                'css_script'    => 'pages/ext/header',
                'js_script'     => 'pages/ext/footer',
                'content'       => 'pages/pcategory/vcategory',
                'category_list' => $this->mod_category->category_list($id_alumni),
                'category'      => $this->mod_category->category($id_alumni),
                'submenu'       => $this->mod_category->submenu($id_alumni),
            );
            $this->load->view('pages/pindex/index', $data);
        }
    }
?>