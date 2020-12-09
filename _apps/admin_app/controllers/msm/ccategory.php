<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Ccategory extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('id_level') == null){
                redirect('../../login');
            }
            $this->load->model(['msm/mod_category']);
            $this->checkAccess = $this->mod_global->check_access_for_this_user($this->session->userdata('id_user'));
        }

        private static function pregReps($string) { 
            return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
        }

        private static function pregRepn($number) { 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function category_list(){
            $data = array(
                'header'   => 'pages/ext/header',
                'footer'   => 'pages/ext/footer',
                'topmenu'  => 'pages/ptopbar/vtopbar',
                'sidemenu' => 'pages/psidebar/vsidebar',
                'content'  => 'pages/msm/pcategory/vcategory',
                'submenu_list' => $this->mod_global->submenu_list(),
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../../_assets/admin/bs-datatables/css/dataTables.bootstrap.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../../_assets/admin/bs-datatables/css/responsive.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../../_assets/global/select2/css/select2.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../../_assets/admin/bs-datatables/js/jquery.dataTables.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../../_assets/admin/bs-datatables/js/dataTables.bootstrap.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../../_assets/admin/bs-datatables/js/dataTables.responsive.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../../_assets/global/select2/js/select2.full.min.js"></script>'
                ),
            );
        	$this->load->view('pages/pindex/index', $data);
        }

        public function table_category(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $category_list = $this->mod_category->get_category_list($length, $start);
            foreach ($category_list as $field){
                if ($field->status_active == 1) {
                    $status = '<lable class="label bg-green">AKTIF</lable>';
                } else {
                    $status = '<lable class="label bg-red">NON-AKTIF</lable>';
                }
                if ($this->checkAccess->id_level != 1) {
                    $btnGod = '';
                } else {
                    $btnGod = '<a href="#" class="btn btn-xs bg-red" data-tooltip="Hapus" onclick="removeData(\''.$this->my_encryption->encrypt_decrypt('encrypt',$field->id_category).'\',\''.$field->category_name.'\')"><i class="fas fa-times"></i></a>';
                }
                $start++;
                $row            = array();
                $row['no']      = $start;
                $row['submenu'] = $field->submenu_name;
                $row['name']    = $field->category_name;
                $row['desc']    = $field->description;
                $row['img']   = '<a href="#" data-tooltip="Lihat" data-toggle="modal" data-target="#modal-img" data-img="../../_assets/img/museum/category/'.$field->image.'"><img src="../../_assets/img/museum/category/'.$field->image.'" width="80"></a>';
                $row['status'] = '<span class="hidden">'.$field->status_active.'</span>'.$status;
                $row['action'] = '
                    <a href="#" class="btn btn-xs bg-blue"  data-toggle="modal" data-target="#modal-edit-category" data-tooltip="Ubah" data-id="'.$field->id_category.'" data-id_menu="'.$field->id_menu.'" data-category="'.$field->category_name.'" data-desc="'.$field->description.'" data-active="'.$field->status_active.'" data-img="../../_assets/img/museum/category/'.$field->image.'" ><i class="fas fa-pen f10"></i></a>
                    '.$btnGod.'
                    ';
                $data[]        = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_category->count_all_category_list(),
                "recordsFiltered" => $this->mod_category->count_filtered_category_list(),
                "data"            => $data
            );
            echo json_encode($output);
        }

        public function save_add_category(){
            if (isset($_FILES)){
                $config = array(
                    'upload_path'   => '../../_assets/img/museum/category/',
                    'allowed_types' => 'jpg|png|jpeg',
                    'max_size'      => '6000',
                    'file_name'     => 'cat-'.date('ymdHis')
                );
                if(!$this->upload->initialize($config)){
                    $error = array('error' => $this->upload->display_errors());
                    echo "Error 1";
                }
                if(isset($_FILES['addimage']['name'])){
                    if($this->upload->do_upload('addimage')){
                        $filename = $this->upload->data();
                        $config = array(
                            'image_library'  => 'gd2',
                            'source_image'   =>  '../../_assets/img/museum/category/'.$filename['file_name'],
                            'create_thumb'   => FALSE,
                            'maintain_ratio' => FALSE,
                            'width'          => 300,
                            'height'         => 200,
                            'quality'        => '50%',
                            'new_image'      =>  '../../_assets/img/museum/category/'.$filename['file_name']
                        );
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                        $data = array(
                            'id_menu'     => $this->pregRepn($this->input->post('id_menu')),
                            'name'        => $this->pregReps($this->input->post('name')),
                            'description' => $this->pregReps($this->input->post('description')),
                            'image'       => $filename['file_name']
                        );
                        $save = $this->mod_global->insert_all('msm_category', $data);
                        if ($save == true) {
                            $dataLog = array(
                                'id_user'     => $this->session->userdata('id_user'),
                                'logs'        => 'Tambah kategori: '.$this->pregReps($this->input->post('name')),
                                'ip_address'  => $this->input->ip_address()
                            );
                            $saveLog = $this->mod_global->insert_all('master_user_log', $dataLog);
                            if ($saveLog == true) {
                                echo "Success";
                            } else {
                                echo "ErrorLog";
                                exit();
                            }
                        } else {
                            echo "Erorr Saving 1";
                        }
                    } else { echo "Error 3"; }
                } else { echo "Error 4"; }
            } else { echo "Error 5"; }
        }

        public function save_edit_category(){
            $id_category = $this->pregRepn($this->input->post('id_category'));
            if ($_FILES['editimage']['size'] !== 0){
                $config = array(
                    'upload_path'   => '../../_assets/img/museum/category/',
                    'allowed_types' => 'jpg|png|jpeg',
                    'max_size'      => '6000',
                    'file_name'     => 'cat-'.date('ymdHis')
                );
                if(!$this->upload->initialize($config)){
                    $error = array('error' => $this->upload->display_errors());
                    echo "ErrorInitialize";exit();
                }
                if(isset($_FILES['editimage']['name'])){
                    $getimage = $this->mod_category->get_image($id_category);
                    if(file_exists('../../_assets/img/museum/category/'.$getimage->image))
                        unlink('../../_assets/img/museum/category/'.$getimage->image);

                    if($this->upload->do_upload('editimage')){
                        $filename = $this->upload->data();
                        $config = array(
                            'image_library'  => 'gd2',
                            'source_image'   =>  '../../_assets/img/museum/category/'.$filename['file_name'],
                            'create_thumb'   => FALSE,
                            'maintain_ratio' => FALSE,
                            'width'          => 300,
                            'height'         => 200,
                            'quality'        => '50%',
                            'new_image'      =>  '../../_assets/img/museum/category/'.$filename['file_name']
                        );
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
                        $data = array(
                            'id_menu'     => $this->pregRepn($this->input->post('id_menu')),
                            'name'        => $this->pregReps($this->input->post('name')),
                            'description' => $this->pregReps($this->input->post('description')),
                            'status_active' => $this->pregRepn($this->input->post('active')),
                            'image'       => $filename['file_name']
                        );
                        $edit = $this->mod_global->edit_all('id_category', $id_category, 'msm_category', $data);
                        if ($edit == true) {
                            $dataLog = array(
                                'id_user'     => $this->session->userdata('id_user'),
                                'logs'        => 'Ubah kategori: '.$this->pregReps($this->input->post('name')),
                                'ip_address'  => $this->input->ip_address()
                            );
                            $saveLog = $this->mod_global->insert_all('master_user_log', $dataLog);
                            if ($saveLog == true) {
                                echo "Success";
                            } else { echo "ErrorLog";exit(); }
                        } 
                    } else { echo "ErrorUpload";exit(); }
                } else { 
                    echo "ImageEmpty";exit();
                }
            } else { 
                $data = array(
                    'id_menu'     => $this->pregRepn($this->input->post('id_menu')),
                    'name'        => $this->pregReps($this->input->post('name')),
                    'description' => $this->pregReps($this->input->post('description')),
                    'status_active' => $this->pregRepn($this->input->post('active'))
                );
                $edit = $this->mod_global->edit_all('id_category', $id_category, 'msm_category', $data);
                if ($edit == true) {
                    $dataLog = array(
                        'id_user'     => $this->session->userdata('id_user'),
                        'logs'        => 'Ubah kategori: '.$this->pregReps($this->input->post('name')),
                        'ip_address'  => $this->input->ip_address()
                    );
                    $saveLog = $this->mod_global->insert_all('master_user_log', $dataLog);
                    if ($saveLog == true) {
                        echo "Success";
                    } else {
                        echo "ErrorLog";exit();
                    }
                } else {
                    echo "ErrorEdit";exit();
                }
            }
        }

        public function delete_category(){
            if ($this->checkAccess->id_level != 1) { echo "ErrorDel";exit(); }
            $id_category = $this->my_encryption->encrypt_decrypt('decrypt', $this->pregReps($this->input->post('id')));
            $name = $this->pregReps($this->input->post('name'));
            $data = array('isDelete' => 1, 'status_active' => 0);
            $isDelete = $this->mod_global->edit_all('id_category', $id_category, 'msm_category', $data);
            if ($isDelete == true){
                $getimage = $this->mod_category->get_image($id_category);
                if(file_exists('../../_assets/img/museum/category/'.$getimage->image))
                    unlink('../../_assets/img/museum/category/'.$getimage->image);
                $dataLog = array(
                    'id_user'    => $this->session->userdata('id_user'),
                    'logs'       => 'Delete kategori : '.$name,
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