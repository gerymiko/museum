<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Chome extends CI_Controller {

        function __construct(){
            parent::__construct();
        }

        public function index(){
            $data = array(
                'css_script' => 'pages/ext/header',
                'js_script'  => 'pages/ext/footer',
                'content' => 'pages/phome/vhome',
            );
            $this->load->view('pages/pindex/index', $data);
        }
    }
?>