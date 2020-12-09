<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Csubmenu extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['msubmenu/mod_submenu']);
        }

        public function submenu_page($id_sekolah){
            $id_sekolah   = $this->my_encryption->encrypt_decrypt('decrypt',$id_sekolah);
            $data = array(
                'css_script' => 'pages/ext/header',
                'js_script'  => 'pages/ext/footer',
                'content'    => 'pages/psubmenu/vsubmenu',
                'submenu' => $this->mod_submenu->submenu($id_sekolah),
            );
            $this->load->view('pages/pindex/index', $data);
        }
    }
?>