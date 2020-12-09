<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Censiklopedia extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['mensiklopedia/mod_ensiklopedia']);
        }

        public function ensiklopedia($id_menu){
            $id_menu = $this->my_encryption->encrypt_decrypt('decrypt',$id_menu);
            $data = array(
                'css_script' => 'pages/ext/header',
                'js_script'  => 'pages/ext/footer',
                'content'    => 'pages/pensiklopedia/vensiklopedia',
                'ensiklopedia' => $this->mod_ensiklopedia->detail_ensiklopedia($id_menu),
                'detail' => $this->mod_ensiklopedia->detail($id_menu)
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function show_thumbnail($id_ensiklo){
            $id_ensiklo   = $this->my_encryption->encrypt_decrypt('decrypt',$id_ensiklo);
            $getFilename = $this->mod_ensiklopedia->get_thumbnail($id_ensiklo);
            $lokasi      = '../../_assets/img/memorial/thumb';
            $filename    = $lokasi.'/'.urldecode($getFilename->thumbnail);
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

        public function show_file($id_ensiklo){
            $id_ensiklo   = $this->my_encryption->encrypt_decrypt('decrypt',$id_ensiklo);
            $getFilename = $this->mod_ensiklopedia->get_file($id_ensiklo);
            $lokasi      = '../../_assets/img/memorial/'.$getFilename->type;
            $filename    = $lokasi.'/'.urldecode($getFilename->file);
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