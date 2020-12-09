<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Calumni extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('id_level') == null){
                redirect('../../login');
            }
            $this->load->model(['mom/mod_alumni']);
            $this->checkAccess = $this->mod_global->check_access_for_this_user($this->session->userdata('id_user'));
        }

        private static function pregReps($string) { 
            return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
        }

        private static function pregRepn($number) { 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function alumni_list(){
            $data = array(
                'header'   => 'pages/ext/header',
                'footer'   => 'pages/ext/footer',
                'topmenu'  => 'pages/ptopbar/vtopbar',
                'sidemenu' => 'pages/psidebar/vsidebar',
                'content'  => 'pages/mom/palumni/valumni',
                'submenu_list' => $this->mod_global->mom_submenu_memorial(),
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
                )
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_alumni(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $alumni_list = $this->mod_alumni->get_alumni_list($length, $start);

            foreach ($alumni_list as $field){
                if ($field->status_active == 1) {
                    $status = '<lable class="label bg-green">AKTIF</lable>';
                } else {
                    $status = '<lable class="label bg-red">NON-AKTIF</lable>';
                }
                if ($this->checkAccess->id_level != 1) {
                    $btnGod = '';
                } else {
                    $btnGod = '<a href="#" class="btn btn-xs bg-red" data-tooltip="Hapus" onclick="removeData(\''.$this->my_encryption->encrypt_decrypt('encrypt',$field->id_alumni).'\',\''.$field->alumni_name.'\')"><i class="fas fa-times"></i></a>';
                }
                $start++;
                $row           = array();
                $row['no']     = $start;
                $row['group']  = $field->submenu_name;
                $row['name']   = $field->alumni_name;
                $row['desc']   = $field->description;
                $row['status'] = '<span class="hidden">'.$field->status_active.'</span>'.$status;
                $row['action'] = '
                    <a href="#" class="btn btn-xs bg-blue" data-tooltip="Ubah" data-toggle="modal" data-target="#modal-edit-alumni" data-id_alumni="'.$this->my_encryption->encrypt_decrypt('encrypt',$field->id_alumni).'" data-id_menu="'.$field->id_menu.'" data-name="'.$field->alumni_name.'" data-desc="'.$field->description.'" data-active="'.$field->status_active.'"><i class="fas fa-pen f10"></i></a>
                    '.$btnGod.'
                    ';
                $data[]        = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_alumni->count_all_alumni_list(),
                "recordsFiltered" => $this->mod_alumni->count_filtered_alumni_list(),
                "data"            => $data
            );
            echo json_encode($output);
        }

        public function save_add_alumni(){
            $data = array(
                'id_menu'       => $this->pregRepn($this->input->post('id_menu')),
                'name'          => $this->pregReps($this->input->post('name')),
                'description'   => $this->pregReps($this->input->post('description'))
            );
            $checkdata = $this->mod_alumni->check_data($this->pregReps($this->input->post('name')));
            if ($checkdata != false) {
                echo 'register';exit();
            }
            $edit = $this->mod_global->insert_all('mom_alumni', $data);
            if ($edit == true) {
                $dataLog = array(
                    'id_user'    => $this->session->userdata('id_user'),
                    'logs'       => 'Tambah Alumni : '.$this->pregReps($this->input->post('name')),
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('master_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMenu";exit();
            }
        }

        public function save_edit_alumni(){
            $id_alumni = $this->my_encryption->encrypt_decrypt('decrypt', $this->pregReps($this->input->post('id_alumni')));
            $data = array(
                'id_menu'       => $this->pregRepn($this->input->post('id_menu')),
                'name'          => $this->pregReps($this->input->post('name')),
                'description'   => $this->pregReps($this->input->post('description')),
                'status_active' => $this->pregRepn($this->input->post('active'))
            );
            $edit = $this->mod_global->edit_all('id_alumni', $id_alumni, 'mom_alumni', $data);
            if ($edit == true) {
                $dataLog = array(
                    'id_user'    => $this->session->userdata('id_user'),
                    'logs'       => 'Edit Alumni : '.$this->pregReps($this->input->post('name')),
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('master_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorAlumni";exit();
            }
        }

        public function delete_alumni(){
            if ($this->checkAccess->id_level != 1) { echo "ErrorDel";exit(); }
            $id_alumni = $this->my_encryption->encrypt_decrypt('decrypt', $this->pregReps($this->input->post('id')));
            $name = $this->pregReps($this->input->post('name'));
            $data = array('isDelete' => 1, 'status_active' => 0);
            $isDelete = $this->mod_global->edit_all('id_alumni', $id_alumni, 'mom_alumni', $data);
            if ($isDelete == true){
                $dataLog = array(
                    'id_user'    => $this->session->userdata('id_user'),
                    'logs'       => 'Delete Alumni : '.$name,
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