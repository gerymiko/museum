<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Cpanel extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('id_level') == null){
                redirect('../../login');
            }
            $this->load->model(['mpanel/mod_panel']);
        }

        private static function pregReps($string) { 
            return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
        }

        private static function pregRepn($number) { 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function dashboard(){
            $data = array(
                'header'   => 'pages/ext/header',
                'footer'   => 'pages/ext/footer',
                'topmenu'  => 'pages/ptopbar/vtopbar',
                'sidemenu' => 'pages/psidebar/vsidebar',
                'content'  => 'pages/ppanel/vpanel',
                'css_script' => array(),
                'js_script'  => array()
            );
        	$this->load->view('pages/pindex/index', $data);
        }

        public function logout(){
            $this->session->unset_userdata('id_user');
            $this->session->unset_userdata('status_active');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('id_level');
            $this->session->unset_userdata('level_name');
            session_destroy();
            ob_clean();
            redirect('../../login');
        }
    }
?>