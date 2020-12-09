<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Censiklopedia extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('id_level') == null){
                redirect('../../login');
            }
            $this->load->model(['mom/mod_ensiklopedia']);
            $this->checkAccess = $this->mod_global->check_access_for_this_user($this->session->userdata('id_user'));
        }

        private static function pregReps($string) { 
            return $result = preg_replace('/[^a-zA-Z0-9- \/_.:()]/','', $string);
        }

        private static function pregRepn($number) { 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function ensiklopedia_list(){
            $data = array(
                'header'   => 'pages/ext/header',
                'footer'   => 'pages/ext/footer',
                'topmenu'  => 'pages/ptopbar/vtopbar',
                'sidemenu' => 'pages/psidebar/vsidebar',
                'content'  => 'pages/mom/pensiklopedia/vensiklopedia',
                'submenu_list' => $this->mod_global->mom_submenu_ensiklopedia(),
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../../_assets/admin/bs-datatables/css/dataTables.bootstrap.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../../_assets/admin/bs-datatables/css/responsive.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../../_assets/global/select2/css/select2.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../../_assets/admin/bs-datatables/js/jquery.dataTables.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../../_assets/admin/bs-datatables/js/dataTables.bootstrap.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../../_assets/admin/bs-datatables/js/dataTables.responsive.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../../_assets/global/select2/js/select2.full.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../../_assets/admin/input-mask/jquery.inputmask.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../../_assets/admin/input-mask/jquery.inputmask.date.extensions.js"></script>',
                )
            );
        	$this->load->view('pages/pindex/index', $data);
        }

        public function table_ensiklopedia(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $ensiklopedia_list = $this->mod_ensiklopedia->get_ensiklopedia_list($length, $start);

            foreach ($ensiklopedia_list as $field){
                if ($field->status_active == 1) {
                    $status = '<lable class="label bg-green">AKTIF</lable>';
                } else {
                    $status = '<lable class="label bg-red">NON-AKTIF</lable>';
                }
                if ($field->type == 'video') {
                    $item = '
                        <a href="#" data-tooltip="Lihat" data-toggle="modal" data-target="#modal-vid" data-vid="../../_assets/img/memorial/'.$field->type.'/'.$field->file.'">
                            <img src="../../_assets/img/memorial/thumb/'.$field->thumbnail.'" width="60" >
                        </a>
                    ';
                } elseif ($field->type == 'gambar') {
                    $item = '
                        <a href="#" data-tooltip="Lihat" data-toggle="modal" data-target="#modal-img" data-img="../../_assets/img/memorial/'.$field->type.'/'.$field->file.'">
                            <img src="../../_assets/img/memorial/thumb/'.$field->thumbnail.'" width="60">
                        </a>';
                } else {
                    $item = '
                        <a href="#" data-tooltip="Lihat" data-toggle="modal" data-target="#modal-doc" data-doc="../../_assets/img/memorial/'.$field->type.'/'.$field->file.'">
                            <img src="../../_assets/img/memorial/thumb/'.$field->thumbnail.'" width="60" >
                        </a>
                    ';
                }
                if ($this->checkAccess->id_level != 1) {
                    $btnGod = '';
                } else {
                    $btnGod = '<a href="#" class="btn btn-xs bg-red" data-tooltip="Hapus" onclick="removeData(\''.$this->my_encryption->encrypt_decrypt('encrypt',$field->id_ensiklo).'\',\''.$field->ensiklo_name.'\')"><i class="fas fa-times"></i></a>';
                }
                $start++;
                $row            = array();
                $row['no']      = $start;
                $row['submenu'] = $field->submenu_name;
                $row['name']    = $field->ensiklo_name;
                $row['desc']    = $field->description;
                $row['date']    = $field->tanggal;
                $row['type']    = $field->type;
                $row['thumb']   = '<a href="#" data-tooltip="Lihat" data-toggle="modal" data-target="#modal-img" data-img="../../_assets/img/memorial/thumb/'.$field->thumbnail.'"><img src="../../_assets/img/memorial/thumb/'.$field->thumbnail.'" width="50"></a>';
                $row['item']   = $item;
                $row['status'] = '<span class="hidden">'.$field->status_active.'</span>'.$status;
                $row['action'] = '
                    <a href="#" class="btn btn-xs bg-blue" data-tooltip="Ubah" data-toggle="modal" data-target="#modal-edit-ensiklopedia" data-id_ensiklo="'.$this->my_encryption->encrypt_decrypt('encrypt',$field->id_ensiklo).'" data-id_menu="'.$field->id_menu.'" data-name="'.$field->ensiklo_name.'" data-desc="'.$field->description.'" data-date="'.$field->tanggal.'" data-type="'.$field->type.'" data-active="'.$field->status_active.'" data-file="../../_assets/img/memorial/'.$field->type.'/'.$field->file.'" data-thumb="../../_assets/img/memorial/thumb/'.$field->thumbnail.'"><i class="fas fa-pen f10"></i></a>
                    '.$btnGod.'
                    ';
                $data[]        = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_ensiklopedia->count_all_ensiklopedia_list(),
                "recordsFiltered" => $this->mod_ensiklopedia->count_filtered_ensiklopedia_list(),
                "data"            => $data
            );
            echo json_encode($output);
        }

        private function create_thumbnail($src, $thumb_target){
            $config_manip = array(
                'image_library'  => 'gd2',
                'source_image'   => $src,
                'maintain_ratio' => FALSE,
                'create_thumb'   => FALSE,
                'width'          => 500,
                'height'         => 300,
                'quality'        => '50%',
                'new_image'      => $thumb_target
            );
            $this->image_lib->initialize($config_manip);
            $this->image_lib->resize();
            $this->image_lib->clear();
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }
        }

        public function save_add_ensiklopedia(){
            $type = $this->pregReps($this->input->post('type'));
            $data = array();
            $src  = "";
            $thumb_target = "";
            $count = count($_FILES['addfile']['name']);
    
            for($i=0;$i<$count;$i++){
                $_FILES['file']['name'] = $_FILES['addfile']['name'][$i];
                $_FILES['file']['type'] = $_FILES['addfile']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['addfile']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['addfile']['error'][$i];
                $_FILES['file']['size'] = $_FILES['addfile']['size'][$i];

                $config['upload_path'] = '../../_assets/img/memorial/'.$type.'/'; 
                $config['allowed_types'] = 'jpg|jpeg|png|mp4|pdf';
                $config['file_name'] = date('ymdHis');

                if(!$this->upload->initialize($config)){
                    $this->upload->display_errors();
                    exit();
                }
                $this->load->library('upload',$config);
                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $data['totalFiles'][] = $filename;
                    $src = '../../_assets/img/memorial/'.$type.'/'.$uploadData['file_name'];
                    $thumb_target = '../../_assets/img/memorial/thumb/'.$uploadData['file_name'];
                } else {
                    echo $this->upload->display_errors();exit();
                }

                if ($type == "gambar") {
                    if (strpos($_FILES['addfile']['name'][0], '.jpeg')) {
                        $extention1 = '.jpeg';
                    } elseif ($_FILES['addfile']['type'][0] == "image/png") {
                        $extention1 = '.png';
                    } elseif ($_FILES['addfile']['type'][0] == "application/pdf") {
                        $extention1 = '.pdf';
                    } elseif ($_FILES['addfile']['type'][0] == "image/jpeg") {
                        $extention1 = '.jpg';
                    } else {
                        $extention1 = '.mp4';
                    }
                    $this->create_thumbnail($src, $thumb_target);
                    $aaa = array(
                        'id_menu'     => $this->pregRepn($this->input->post('id_menu')),
                        'name'        => $this->pregReps($this->input->post('name')),
                        'description' => $this->pregReps($this->input->post('description')),
                        'tanggal'     => $this->pregReps($this->input->post('date')),
                        'type'        => $type,
                        'file'        => date('ymdHis').$extention1,
                        'thumbnail'   => date('ymdHis').$extention1
                    );
                }
                if ($type != "gambar" && ($_FILES['addfile']['type'][1] == "image/jpeg" || $_FILES['addfile']['type'][1] == "image/png" ) ) {
                    $this->create_thumbnail($src, $thumb_target);
                    if (strpos($_FILES['addfile']['name'][0], '.jpeg')) {
                        $extention1 = '.jpeg';
                    } elseif ($_FILES['addfile']['type'][0] == "image/png") {
                        $extention1 = '.png';
                    } elseif ($_FILES['addfile']['type'][0] == "application/pdf") {
                        $extention1 = '.pdf';
                    } elseif ($_FILES['addfile']['type'][0] == "image/jpeg") {
                        $extention1 = '.jpg';
                    } else {
                        $extention1 = '.mp4';
                    }

                    if (strpos($_FILES['addfile']['name'][1], '.jpeg')) {
                        $extention2 = '.jpeg';
                    } elseif ($_FILES['addfile']['type'][1] == "image/png") {
                        $extention2 = '.png';
                    } elseif ($_FILES['addfile']['type'][1] == "application/pdf") {
                        $extention2 = '.pdf';
                    } elseif ($_FILES['addfile']['type'][1] == "image/jpeg") {
                        $extention2 = '.jpg';
                    } else {
                        $extention2 = '.mp4';
                    }

                    $aaa = array(
                        'id_menu'     => $this->pregRepn($this->input->post('id_menu')),
                        'name'        => $this->pregReps($this->input->post('name')),
                        'description' => $this->pregReps($this->input->post('description')),
                        'tanggal'     => $this->pregReps($this->input->post('date')),
                        'type'        => $type,
                        'file'        => date('ymdHis').$extention1,
                        'thumbnail'   => date('ymdHis').$extention2
                    );
                }
            }
            if ($count == 2) {
                unlink($src);
            }
            $save = $this->mod_global->insert_all('mom_ensiklopedia', $aaa);
            if ($save == true) {
                $dataLog = array(
                    'id_user'    => $this->session->userdata('id_user'),
                    'logs'       => 'Tambah Ensiklopedia: '.$this->pregReps($this->input->post('name')),
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('master_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {echo "Erorr Saving 1";exit();}
        }

        public function save_edit_ensiklopedia(){
            $id_ensiklo = $this->my_encryption->encrypt_decrypt('decrypt',$this->pregReps($this->input->post('id_ensiklo')));
            $type = $this->pregReps($this->input->post('type'));
            $data = array();
            $src  = "";
            $thumb_target = "";
            $count = count($_FILES['editfile']['name']);

            if ($_FILES['editfile']['name'][0] == "" || $_FILES['editfile']['name'][1] == "") {
                $alldata = array(
                    'id_menu' => $this->pregRepn($this->input->post('id_menu')),
                    'name'        => $this->pregReps($this->input->post('name')),
                    'description' => $this->pregReps($this->input->post('description')),
                    'tanggal'     => $this->pregReps($this->input->post('date')),
                    'status_active' => $this->pregRepn($this->input->post('active'))
                );
                $save = $this->mod_global->edit_all('id_ensiklo', $id_ensiklo, 'mom_ensiklopedia', $alldata);
                if ($save == true) {
                    $dataLog = array(
                        'id_user'    => $this->session->userdata('id_user'),
                        'logs'       => 'Ubah Ensiklopedia: '.$this->pregReps($this->input->post('name')),
                        'ip_address' => $this->input->ip_address()
                    );
                    $saveLog = $this->mod_global->insert_all('master_user_log', $dataLog);
                    if ($saveLog == true) { echo "Success";
                    } else { echo "ErrorLog";exit(); }
                } else {echo "ErrorSaving";exit();}
            } else {
                for($i=0; $i < $count; $i++){
                    $_FILES['file']['name'] = $_FILES['editfile']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['editfile']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['editfile']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['editfile']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['editfile']['size'][$i];

                    $config['upload_path'] = '../../_assets/img/memorial/'.$type.'/'; 
                    $config['allowed_types'] = 'jpg|jpeg|png|mp4|pdf';
                    $config['file_name'] = date('ymdHis');

                    if(!$this->upload->initialize($config)){
                        $this->upload->display_errors();exit();
                    }
                    $this->load->library('upload',$config);
                    if($this->upload->do_upload('file')){
                        $uploadData = $this->upload->data();
                        $filename = $uploadData['file_name'];
                        $data['totalFiles'][] = $filename;
                        $src = '../../_assets/img/memorial/'.$type.'/'.$uploadData['file_name'];
                        $thumb_target = '../../_assets/img/memorial/thumb/'.$uploadData['file_name'];
                    } else {
                        echo $this->upload->display_errors();exit();
                    }
                    if ($type == "gambar") {
                        if (strpos($_FILES['editfile']['name'][0], '.jpeg')) {
                            $extention1 = '.jpeg';
                        } elseif ($_FILES['editfile']['type'][0] == "image/png") {
                            $extention1 = '.png';
                        } elseif ($_FILES['editfile']['type'][0] == "application/pdf") {
                            $extention1 = '.pdf';
                        } elseif ($_FILES['editfile']['type'][0] == "image/jpeg") {
                            $extention1 = '.jpg';
                        } else {
                            $extention1 = '.mp4';
                        }
                        $this->create_thumbnail($src, $thumb_target);
                        $alldata = array(
                            'id_menu'       => $this->pregRepn($this->input->post('id_menu')),
                            'name'          => $this->pregReps($this->input->post('name')),
                            'description'   => $this->pregReps($this->input->post('description')),
                            'tanggal'       => $this->pregReps($this->input->post('date')),
                            'status_active' => $this->pregRepn($this->input->post('active')),
                            'type'          => $type,
                            'file'          => date('ymdHis').$extention1,
                            'thumbnail'     => date('ymdHis').$extention1
                        );
                    }
                    if ($type != "gambar" && ($_FILES['editfile']['type'][1] == "image/jpeg" || $_FILES['editfile']['type'][1] == "image/png" ) ) {
                        $this->create_thumbnail($src, $thumb_target);
                        if (strpos($_FILES['editfile']['name'][0], '.jpeg')) {
                            $extention1 = '.jpeg';
                        } elseif ($_FILES['editfile']['type'][0] == "image/png") {
                            $extention1 = '.png';
                        } elseif ($_FILES['editfile']['type'][0] == "application/pdf") {
                            $extention1 = '.pdf';
                        } elseif ($_FILES['editfile']['type'][0] == "image/jpeg") {
                            $extention1 = '.jpg';
                        } else {
                            $extention1 = '.mp4';
                        }

                        if (strpos($_FILES['editfile']['name'][1], '.jpeg')) {
                            $extention2 = '.jpeg';
                        } elseif ($_FILES['editfile']['type'][1] == "image/png") {
                            $extention2 = '.png';
                        } elseif ($_FILES['editfile']['type'][1] == "application/pdf") {
                            $extention2 = '.pdf';
                        } elseif ($_FILES['editfile']['type'][1] == "image/jpeg") {
                            $extention2 = '.jpg';
                        } else {
                            $extention2 = '.mp4';
                        }
                        $alldata = array(
                            'id_menu'       => $this->pregRepn($this->input->post('id_menu')),
                            'name'          => $this->pregReps($this->input->post('name')),
                            'description'   => $this->pregReps($this->input->post('description')),
                            'tanggal'       => $this->pregReps($this->input->post('date')),
                            'status_active' => $this->pregRepn($this->input->post('active')),
                            'file'          => date('ymdHis').$extention1,
                            'thumbnail'     => date('ymdHis').$extention2
                        );
                    }
                }
                if ($count == 2) { unlink($src); }
                $getimage = $this->mod_ensiklopedia->get_image($id_ensiklo);
                if(file_exists('../../_assets/img/memorial/'.$getimage->type.'/'.$getimage->file))
                    unlink('../../_assets/img/memorial/'.$getimage->type.'/'.$getimage->file);
                if(file_exists('../../_assets/img/memorial/thumb/'.$getimage->thumbnail))
                    unlink('../../_assets/img/memorial/thumb/'.$getimage->thumbnail);
                $save = $this->mod_global->edit_all('id_ensiklo', $id_ensiklo, 'mom_ensiklopedia', $alldata);
                if ($save == true) {
                    $dataLog = array(
                        'id_user'    => $this->session->userdata('id_user'),
                        'logs'       => 'Ubah Ensiklopedia: '.$this->pregReps($this->input->post('name')),
                        'ip_address' => $this->input->ip_address()
                    );
                    $saveLog = $this->mod_global->insert_all('master_user_log', $dataLog);
                    if ($saveLog == true) { echo "Success";
                    } else { echo "ErrorLog";exit(); }
                } else {echo "Erorr Saving 1";exit();}
            }
        }

        public function delete_ensiklopedia(){
            if ($this->checkAccess->id_level != 1) { echo "ErrorDel";exit(); }
            $id_ensiklo = $this->my_encryption->encrypt_decrypt('decrypt', $this->pregReps($this->input->post('id')));
            $name = $this->pregReps($this->input->post('name'));
            $data = array('isDelete' => 1, 'status_active' => 0);
            $isDelete = $this->mod_global->edit_all('id_ensiklo', $id_ensiklo, 'mom_ensiklopedia', $data);
            if ($isDelete == true){
                $getimage = $this->mod_ensiklopedia->get_image($id_ensiklo);
                if(file_exists('../../_assets/img/memorial/'.$getimage->type.'/'.$getimage->file))
                    unlink('../../_assets/img/memorial/'.$getimage->type.'/'.$getimage->file);
                if(file_exists('../../_assets/img/memorial/thumb/'.$getimage->thumbnail))
                    unlink('../../_assets/img/memorial/thumb/'.$getimage->thumbnail);
                $dataLog = array(
                    'id_user'    => $this->session->userdata('id_user'),
                    'logs'       => 'Delete Ensiklopedia : '.$name,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('master_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorDel";exit();
            }
        }
    }
?>