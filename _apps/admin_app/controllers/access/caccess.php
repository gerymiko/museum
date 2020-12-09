<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Caccess extends CI_Controller{

        function __construct(){
            parent::__construct();
            $this->checkAccess = $this->mod_global->check_access_for_this_user($this->session->userdata('id_user'));
            if ($this->session->userdata('id_user') == null && $this->session->userdata('id_level') == null){
                redirect('../../login');
            } elseif ($this->checkAccess->id_level != 1 ) {
                $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>Sorry, You do not have authority to access the page.');
                        $this->session->set_flashdata('pesan', $pesan);
                redirect('../../dashboard');
            }
            $this->load->model(['maccess/mod_access']);
        }

        private static function pregReps($string) { 
            return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
        }

        private static function pregRepn($number) { 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function pregPass($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9]/','', $string);
        }

        private static function strEncode($password){ 
            return $result = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE)));
        }

        public function access_list(){
            $data = array(
                'header'   => 'pages/ext/header',
                'footer'   => 'pages/ext/footer',
                'topmenu'  => 'pages/ptopbar/vtopbar',
                'sidemenu' => 'pages/psidebar/vsidebar',
                'content'  => 'pages/paccess/vaccess',
                'accessRights' => $this->checkAccess,
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

        public function table_user(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $access = $this->mod_access->get_user_list($length, $start);

            foreach ($access as $field){
                if ($field->status_active == 1) {
                    $status = '<lable class="label bg-green">AKTIF</lable>';
                } else {
                    $status = '<lable class="label bg-red">NON-AKTIF</lable>';
                }
                if ($this->checkAccess->id_level != 1) {
                    $btnGod = '';
                } else {
                    $btnGod = '<a href="#" class="btn btn-xs bg-red" data-tooltip="Hapus" onclick="removeData(\''.$this->my_encryption->encrypt_decrypt('encrypt',$field->id_user).'\',\''.$field->username.'\')"><i class="fas fa-times"></i></a>';
                }
                $start++;
                $row             = array();
                $row['no']       = $start;
                $row['username'] = $field->username;
                $row['level']    = $field->level_name;
                $row['register'] = date("d-m-Y H:i A", strtotime($field->insert_time));
                $row['status']   = '<span class="hidden">'.$field->status_active.'</span>'.$status;
                $row['action']   = '
                    <a href="#" class="btn btn-xs bg-blue" data-tooltip="Ubah" data-toggle="modal" data-target="#modal-edit-user" data-id_user="'.$this->my_encryption->encrypt_decrypt('encrypt',$field->id_user).'" data-username="'.$field->username.'" data-level="'.$field->id_level.'" data-active="'.$field->status_active.'"><i class="fas fa-pen f10"></i></a>
                    '.$btnGod.'
                    ';
                $data[]        = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_access->count_all_user_list(),
                "recordsFiltered" => $this->mod_access->count_filtered_user_list(),
                "data"            => $data
            );
            echo json_encode($output);
        }

        public function save_add_user(){
            $username  = $this->pregReps($this->input->post('username'));
            $password  = $this->pregPass($this->input->post('password'));
            $checkdata = $this->mod_access->check_user($username);
            if ($checkdata != false) {
                echo "register";exit();
            }
            if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password)){
                echo 'notsecure';exit();
            }
            $data = array(
                'username' => $username,
                'password' => $this->strEncode($this->pregPass($this->input->post('password'))),
                'id_level' => $this->pregRepn($this->input->post('level'))
            );
            $save = $this->mod_global->insert_all('master_user', $data);
            if ($save == true) {
                $dataLog = array(
                    'id_user'     => $this->session->userdata('id_user'),
                    'logs'        => 'Tambah User: '.$username,
                    'ip_address'  => $this->input->ip_address()
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

        public function save_edit_user(){
            $id_user = $this->my_encryption->encrypt_decrypt('decrypt',$this->pregReps($this->input->post('id_user')));
            $username  = $this->pregReps($this->input->post('username'));
            $new_password  = $this->pregPass($this->input->post('new_password'));
            if ($new_password == null || $new_password == "") {
                $data = array(
                    'id_level' => $this->pregRepn($this->input->post('level')),
                    'status_active' => $this->pregRepn($this->input->post('active'))
                );
            } else {
                $data = array(
                    'password' => $this->strEncode($new_password),
                    'id_level' => $this->pregRepn($this->input->post('level')),
                    'status_active' => $this->pregRepn($this->input->post('active'))
                );
            }
            $save = $this->mod_global->edit_all('id_user', $id_user, 'master_user', $data);
            if ($save == true) {
                $dataLog = array(
                    'id_user'     => $this->session->userdata('id_user'),
                    'logs'        => 'Ubah User: '.$username,
                    'ip_address'  => $this->input->ip_address()
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
    }
?>