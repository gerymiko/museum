<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Cabout extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('id_level') == null){
                redirect('../../login');
            }
            $this->load->model(['mom/mod_about']);
            $this->checkAccess = $this->mod_global->check_access_for_this_user($this->session->userdata('id_user'));
        }

        private static function pregReps($string) { 
            return $result = preg_replace('/[^a-zA-Z0-9- \/_.:()]/','', $string);
        }

        private static function pregRepn($number) { 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function about_list(){
            $data = array(
                'header'   => 'pages/ext/header',
                'footer'   => 'pages/ext/footer',
                'topmenu'  => 'pages/ptopbar/vtopbar',
                'sidemenu' => 'pages/psidebar/vsidebar',
                'content'  => 'pages/mom/pabout/vabout',
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../../_assets/admin/bs-datatables/css/dataTables.bootstrap.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../../_assets/admin/bs-datatables/css/responsive.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../../_assets/global/bs-wysihtml5/bs-wysihtml5.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../../_assets/admin/bs-datatables/js/jquery.dataTables.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../../_assets/admin/bs-datatables/js/dataTables.bootstrap.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../../_assets/admin/bs-datatables/js/dataTables.responsive.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../../_assets/global/bs-wysihtml5/bs-wysihtml5.all.min.js"></script>'
                )
            );
        	$this->load->view('pages/pindex/index', $data);
        }

        public function table_about(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $about = $this->mod_about->get_about($length, $start);

            foreach ($about as $field){
                if ($field->status_active == 1) {
                    $status = '<lable class="label bg-green">AKTIF</lable>';
                } else {
                    $status = '<lable class="label bg-red">NON-AKTIF</lable>';
                }
                $start++;
                $row           = array();
                $row['no']     = $start;
                $row['name']   = $field->name;
                $row['desc']   = $field->description;
                $row['status'] = '<span class="hidden">'.$field->status_active.'</span>'.$status;
                $row['action'] = '
                    <a href="#" class="btn btn-xs bg-blue" data-tooltip="Ubah" data-toggle="modal" data-target="#modal-edit-about" data-id="'.$this->my_encryption->encrypt_decrypt('encrypt',$field->id).'" data-name="'.$field->name.'" data-desc="'.html_entity_decode($field->description).'" data-active="'.$field->status_active.'"><i class="fas fa-pen f10"></i></a>';
                $data[]        = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_about->count_all_about(),
                "recordsFiltered" => $this->mod_about->count_filtered_about(),
                "data"            => $data
            );
            echo json_encode($output);
        }

        public function save_edit_about(){
            $id = $this->my_encryption->encrypt_decrypt('decrypt', $this->pregReps($this->input->post('id')));
            $name = $this->pregReps($this->input->post('name'));
            $desc = $this->security->xss_clean($this->input->post('description'));
            $data = array(
                'name'          => $name,
                'description'   => $desc,
                'status_active' => $this->pregRepn($this->input->post('status'))
            );
            $save = $this->mod_global->edit_all('id', $id, 'master_about', $data);
            if ($save == true) {
                $dataLog = array(
                    'id_user'    => $this->session->userdata('id_user'),
                    'logs'       => 'Ubah tentang: '.$name,
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
    }
?>