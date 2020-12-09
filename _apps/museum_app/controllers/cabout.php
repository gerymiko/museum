<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Cabout extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['mabout/mod_about']);
        }

        public function index(){
            $data = array(
                'css_script' => 'pages/ext/header',
                'js_script'  => 'pages/ext/footer',
                'content' => 'pages/pabout/vabout',
                'about' => $this->mod_about->about()
            );
            $this->load->view('pages/pindex/index', $data);
        }
    }
?>