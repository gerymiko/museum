<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Csekolah extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['msekolah/mod_sekolah']);
        }

        public function index(){
            $data = array(
                'css_script' => 'pages/ext/header',
                'js_script'  => 'pages/ext/footer',
                'content'    => 'pages/psekolah/vsekolah',
                'sekolah' => $this->mod_sekolah->sekolah(),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function poster_sekolah($id){
            $id   = $this->my_encryption->encrypt_decrypt('decrypt',$id);
            $getFilename = $this->mod_sekolah->get_image($id);
            $lokasi   = '../../_assets/img/memorial/poster';
            $filename = $lokasi.'/'.urldecode($getFilename->image);
            header('Content-Description: File Transfer');
            header('Content-Type: application/file');
            header('Content-Disposition: attachment; filename='.basename($filename));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            header("Last-Modified: ".date ("D, d M Y H:i:s", filemtime($filename))." GMT");
            ob_clean();
            flush();
            readfile($filename);
            exit;
        }

        public function logo_sekolah($id){
            $id   = $this->my_encryption->encrypt_decrypt('decrypt',$id);
            $sekolah = ($id == 1) ? 'smp' : 'sma';
            $lokasi   = '../../_assets/img/memorial/logo';
            $filename = $lokasi.'/'.urldecode('logo_'.$sekolah.'.png');
            header('Content-Description: File Transfer');
            header('Content-Type: application/file');
            header('Content-Disposition: attachment; filename='.basename($filename));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            header("Last-Modified: ".date ("D, d M Y H:i:s", filemtime($filename))." GMT");
            ob_clean();
            flush();
            readfile($filename);
            exit;
        }
    }
?>