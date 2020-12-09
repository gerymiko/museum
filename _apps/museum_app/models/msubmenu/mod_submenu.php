<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_submenu extends CI_Model {
		
		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    function submenu(){
	    	$datax = array('status_active' => 1, 'isDelete' => 0);
	    	$query = $this->db->from('msm_submenu')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }
	}
?>