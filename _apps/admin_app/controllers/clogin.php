    <?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Clogin extends CI_Controller {

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') !== null && $this->session->userdata('id_level') !== null) {
                redirect('../../dashboard');
            }
            $this->load->model(['mlogin/mod_login']);
        }

        public function index(){
            $data = array(
                'header'     => 'pages/ext/header',
                'footer'     => 'pages/ext/footer',
                'css_script' => array(),
                'js_script'  => array(),
            );
        	$this->load->view('pages/plogin/vlogin', $data);
        }

        public function auth_login(){
            $username   = $this->security->xss_clean($this->input->post('username'));
            $password   = $this->security->xss_clean($this->input->post('password'));
            $check_user = $this->mod_login->check_login($username, $password);
            if($check_user !== false){
                $sessionData = array(
                    'id_user'       => $check_user['id_user'],
                    'id_level'      => $check_user['id_level'],
                    'username'      => $check_user['username'],
                    'level_name'    => $check_user['level_name'],
                    'status_active' => $check_user['status_active']
                );
                $this->session->set_userdata($sessionData);
                if ($check_user['status_active'] == 0) {
                    $validator['success'] = false;
                    $validator['message'] = '<p class="alert alert-danger">Account has been suspended<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>';
                } else {
                    $datalogs = array(
                        'id_user'    => $check_user['id_user'],
                        'logs'       => 'Login Adminsite',
                        'ip_address' => $this->input->ip_address()
                    );
                    $this->mod_global->insert_all('master_user_log', $datalogs);
                    $validator['success']  = true;  
                    $validator['redirect'] = base_url('../../dashboard');
                }
            } else {
                $validator['success'] = false;
                $validator['message'] = '<p class="alert alert-danger"><b>Oops!</b> Wrong Username or password<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>';  
            }
            echo json_encode($validator);
        }
    }
?>