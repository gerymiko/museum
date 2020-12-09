<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_category extends CI_Model {

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

	    function category_list($id_alumni){
	    	$datax = array('b.id_alumni' => $this->pregRepn($id_alumni), 'a.isDelete' => 0, 'b.isDelete' => 0, 'c.isDelete' => 0);
	    	$query = $this->db->select('a.id_menu, a.id_sekolah, b.id_alumni, a.name as submenu_name, b.name as alumni_name, c.id_category, c.name as category_name, c.description')
	    		->from('mom_submenu a')
	    		->join('mom_alumni b', 'a.id_menu = b.id_menu AND b.status_active = 1', 'inner')
	    		->join('mom_alumni_category c', 'b.id_alumni = c.id_alumni', 'left')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	    function category($id_alumni){
	    	$datax = array('b.id_alumni' => $this->pregRepn($id_alumni), 'a.isDelete' => 0, 'b.isDelete' => 0, 'c.isDelete' => 0);
	    	$query = $this->db->select('a.id_menu, a.id_sekolah, b.id_alumni, a.name as submenu_name, b.name as alumni_name, c.id_category, c.name as category_name, c.description')
	    		->from('mom_submenu a')
	    		->join('mom_alumni b', 'a.id_menu = b.id_menu AND b.status_active = 1', 'inner')
	    		->join('mom_alumni_category c', 'b.id_alumni = c.id_alumni AND c.status_active = 1', 'right')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function submenu($id_alumni){
	    	$datax = array('b.id_alumni' => $this->pregRepn($id_alumni), 'a.isDelete' => 0, 'b.isDelete' => 0);
	    	$query = $this->db->select('a.id_menu, a.id_sekolah, b.id_alumni, a.alias_name, a.name as submenu_name, b.name as alumni_name')
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