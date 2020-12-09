<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_submenu extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
            return $result;
        }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    function submenu($id_sekolah){
	    	$datax = array('status_active' => 1, 'isDelete' => 0, 'id_sekolah' => $this->pregRepn($id_sekolah));
	    	$query = $this->db->select('id_menu, id_sekolah, alias_name, name, description, status_active')
	    		->from('mom_submenu')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	}
?>