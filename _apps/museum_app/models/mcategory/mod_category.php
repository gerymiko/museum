<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_category extends CI_Model {
		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }
	    
	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    function category($id_menu){
	    	$datax = array('status_active' => 1, 'id_menu' => $this->pregRepn($id_menu), 'isDelete' => 0 );
	    	$query = $this->db->select('id_category, id_menu, name, description, image, status_active')
	    		->from('msm_category')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	}
?>