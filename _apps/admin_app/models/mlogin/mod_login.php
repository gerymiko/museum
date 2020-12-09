<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_login extends CI_Model{

		function __construct(){
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function strEncode($password){ 
	        return $result = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE)));
	    }

	    private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

	    function check_login($username, $password){
	    	$password = $this->security->xss_clean($password);
	    	$datax = array( 'a.username' => $this->security->xss_clean($username), 'a.password' => $this->strEncode($password) );
	    	$query = $this->db->select('a.id_user, a.id_level, a.username, b.level_name, a.status_active')
	    			->from('master_user a')
	    			->join('master_user_level b', 'a.id_level = b.id_level AND b.status_active = 1', 'inner')
					->where($datax)
					->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row_array(); 
	       	} else { return false; }
	    }


	}
?>