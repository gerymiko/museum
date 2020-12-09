<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Cdetail extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['mdetail/mod_detail']);
        }

        public function detail($id_category){
            $id_category = $this->my_encryption->encrypt_decrypt('decrypt',$id_category);
            $data = array(
                'css_script' => 'pages/ext/header',
                'js_script'  => 'pages/ext/footer',
                'content'    => 'pages/pdetail/vdetail',
                'detail'     => $this->mod_detail->detail($id_category),
                'detail_category' => $this->mod_detail->detail_category($id_category),
                'submenu' => $this->mod_detail->submenu($id_category)
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function show_thumbnail($id_detail){
            $id_detail   = $this->my_encryption->encrypt_decrypt('decrypt',$id_detail);
            $getFilename = $this->mod_detail->get_thumbnail($id_detail);
            $lokasi      = '../../_assets/img/museum/thumb';
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

        public function show_file($id_detail){
            $id_detail   = $this->my_encryption->encrypt_decrypt('decrypt',$id_detail);
            $getFilename = $this->mod_detail->get_file($id_detail);
            $lokasi      = '../../_assets/img/museum/'.$getFilename->type;
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