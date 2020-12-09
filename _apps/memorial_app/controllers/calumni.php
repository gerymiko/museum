<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Calumni extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['malumni/mod_alumni']);
        }

        public function alumni_list($id_alumni){
            $id_alumni = $this->my_encryption->encrypt_decrypt('decrypt',$id_alumni);
            $data = array(
                'css_script'  => 'pages/ext/header',
                'js_script'   => 'pages/ext/footer',
                'content'     => 'pages/palumni/valumni',
                'alumni_list' => $this->mod_alumni->alumni_list($id_alumni),
                'alumni'      => $this->mod_alumni->alumni($id_alumni),
            );
            $this->load->view('pages/pindex/index', $data);
        }
    }
?>