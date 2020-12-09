<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Cschool extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('id_level') == null){
                redirect('../../login');
            }
            $this->load->model(['mom/mod_school']);
        }

        private static function pregReps($string) { 
            return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
        }

        private static function pregRepn($number) { 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function school_list(){
            $data = array(
                'header'   => 'pages/ext/header',
                'footer'   => 'pages/ext/footer',
                'topmenu'  => 'pages/ptopbar/vtopbar',
                'sidemenu' => 'pages/psidebar/vsidebar',
                'content'  => 'pages/mom/pschool/vschool',
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

        public function table_school(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $school = $this->mod_school->get_school($length, $start);

            foreach ($school as $field){
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
                $row['img']    = '<a href="#" data-tooltip="Lihat" data-toggle="modal" data-target="#modal-img" data-img="../../_assets/img/memorial/poster/'.$field->image.'"><img src="../../_assets/img/memorial/poster/'.$field->image.'" width="80"></a>';
                $row['status'] = '<span class="hidden">'.$field->status_active.'</span>'.$status;
                $row['action'] = '
                    <a href="#" class="btn btn-xs bg-blue" data-tooltip="Ubah" data-toggle="modal" data-target="#modal-edit-school" data-id="'.$this->my_encryption->encrypt_decrypt('encrypt',$field->id_sekolah).'" data-name="'.$field->name.'" data-desc="'.$field->description.'" data-img="../../_assets/img/memorial/poster/'.$field->image.'" data-active="'.$field->status_active.'"><i class="fas fa-pen f10"></i></a>';
                $data[]        = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_school->count_all_school(),
                "recordsFiltered" => $this->mod_school->count_filtered_school(),
                "data"            => $data
            );
            echo json_encode($output);
        }

        public function save_edit_school(){
            $id_sekolah = $this->my_encryption->encrypt_decrypt('decrypt',$this->pregReps($this->input->post('id_sekolah')));
            if ($_FILES['editimage']['size'] !== 0){
                $config = array(
                    'upload_path'   => '../../_assets/img/memorial/poster/',
                    'allowed_types' => 'jpg|png|jpeg',
                    'max_size'      => '1000',
                    'file_name'     => 'poster-'.date('ymdHis')
                );
                if(!$this->upload->initialize($config)){
                    $error = array('error' => $this->upload->display_errors());
                    echo "ErrorInitialize";exit();
                }
                if(isset($_FILES['editimage']['name'])){
                    $getimage = $this->mod_school->get_image($id_sekolah);
                    if(file_exists('../../_assets/img/memorial/poster/'.$getimage->image))
                        unlink('../../_assets/img/memorial/poster/'.$getimage->image);

                    if($this->upload->do_upload('editimage')){
                        $filename = $this->upload->data();
                        $config = array(
                            'image_library'  => 'gd2',
                            'source_image'   =>  '../../_assets/img/memorial/poster/'.$filename['file_name'],
                            'create_thumb'   => FALSE,
                            'maintain_ratio' => FALSE,
                            'width'          => 600,
                            'height'         => 300,
                            'quality'        => '50%',
                            'new_image'      =>  '../../_assets/img/memorial/poster/'.$filename['file_name']
                        );
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                        $data = array(
                            'name'          => $this->pregReps($this->input->post('name')),
                            'description'   => $this->pregReps($this->input->post('description')),
                            'status_active' => $this->pregRepn($this->input->post('active')),
                            'image'         => $filename['file_name']
                        );
                        $edit = $this->mod_global->edit_all('id_sekolah', $id_sekolah, 'mom_sekolah', $data);
                        if ($edit == true) {
                            $dataLog = array(
                                'id_user'     => $this->session->userdata('id_user'),
                                'logs'        => 'Ubah sekolah: '.$this->pregReps($this->input->post('name')),
                                'ip_address'  => $this->input->ip_address()
                            );
                            $saveLog = $this->mod_global->insert_all('master_user_log', $dataLog);
                            if ($saveLog == true) {
                                echo "Success";
                            } else {
                                echo "ErrorLog";exit();
                            }
                        } 
                    } else { echo "ErrorUpload";exit(); }
                } else { 
                    echo "ImageEmpty";exit();
                }
            } else { 
                $data = array(
                    'name'        => $this->pregReps($this->input->post('name')),
                    'description' => $this->pregReps($this->input->post('description')),
                    'status_active' => $this->pregRepn($this->input->post('active'))
                );
                $edit = $this->mod_global->edit_all('id_sekolah', $id_sekolah, 'mom_sekolah', $data);
                if ($edit == true) {
                    $dataLog = array(
                        'id_user'     => $this->session->userdata('id_user'),
                        'logs'        => 'Ubah sekolah: '.$this->pregReps($this->input->post('name')),
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
    }
?>