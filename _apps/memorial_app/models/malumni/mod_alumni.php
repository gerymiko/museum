<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_alumni extends CI_Model {

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

	    function alumni_list($id_menu){
	    	$datax = array('a.id_menu' => $this->pregRepn($id_menu), 'a.isDelete' => 0, 'b.isDelete' => 0);
	    	$query = $this->db->select('a.id_menu, a.id_sekolah, b.id_alumni, a.alias_name, a.name as submenu_name, b.name as alumni_name, b.description')
	    		->from('mom_submenu a')
	    		->join('mom_alumni b', 'a.id_menu = b.id_menu AND b.status_active = 1', 'inner')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	    function alumni($id_menu){
	    	$datax = array('a.id_menu' => $this->pregRepn($id_menu), 'a.isDelete' => 0, 'b.isDelete' => 0);
	    	$query = $this->db->select('a.id_menu, a.id_sekolah, b.id_alumni, a.alias_name, a.name as submenu_name, b.name as alumni_name, b.description')
	    		->from('mom_submenu a')
	    		->join('mom_alumni b', 'a.id_menu = b.id_menu AND b.status_active = 1', 'inner')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }
	}
?>