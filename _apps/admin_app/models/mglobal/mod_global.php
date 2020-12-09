<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_global extends CI_Model {

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

	    function insert_all($table, $data) {
	        $this->db->insert($table, $data);
	        return ($this->db->affected_rows() != 1 ) ? false:true;
	    }

	    function edit_all($field, $id, $table, $data){
			$this->db->where($field, $id);
			$this->db->update($table, $data);
			return ( $this->db->affected_rows() != 1 ) ? false:true;
		}

		function submenu_list(){
			$datax = array('status_active' => 1, 'isDelete' => 0);
			$query = $this->db->select('id_menu, name, status_active')
				->from('msm_submenu')
				->where($datax)
				->get()
				->result();
			return $query;
		}

		function category_list(){
			$datax = array('status_active' => 1, 'isDelete' => 0);
			$query = $this->db->select('id_category, id_menu, name, status_active')
				->from('msm_category')
				->where($datax)
				->get()
				->result();
			return $query;
		}

		function check_access_for_this_user($id_user){
			$datax =array('a.id_user' => $this->pregRepn($id_user), 'a.status_active' => 1);
	    	$query = $this->db->select('a.id_user, b.id_level')
	    		->from('master_user a')
	    		->join('master_user_level b', 'a.id_level = b.id_level', 'inner')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row();
	    	} else { return false; }
		}

		function mom_submenu_ensiklopedia(){
			$array = array('1', '3');
			$datax = array('status_active' => 1, 'isDelete' => 0);
			$query = $this->db->select('id_menu, name, status_active')
				->from('mom_submenu')
				->where($datax)
				->where_in('id_menu', $array)
				->get()
				->result();
			return $query;
		}

		function mom_submenu_memorial(){
			$array = array('2', '4');
			$datax = array('status_active' => 1, 'isDelete' => 0);
			$query = $this->db->select('id_menu, name, status_active')
				->from('mom_submenu')
				->where($datax)
				->where_in('id_menu', $array)
				->get()
				->result();
			return $query;
		}

		function mom_alumni_list(){
			$datax = array('status_active' => 1, 'isDelete' => 0);
			$query = $this->db->select('id_alumni, name, status_active')
				->from('mom_alumni')
				->where($datax)
				->get()
				->result();
			return $query;
		}

		function mom_category(){
			$datax = array('status_active' => 1, 'isDelete' => 0);
			$query = $this->db->select('id_category, name, status_active')
				->from('mom_alumni_category')
				->where($datax)
				->get()
				->result();
			return $query;
		}

	}
?>