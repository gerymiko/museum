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
	    
	    function edit_not_in($id_user, $field, $id, $table, $data){
	    	$this->db->where('id_user', $this->pregRepn($id_user));
			$this->db->where_not_in($field, $id);
			$this->db->update($table, $data);
			return ( $this->db->affected_rows() != 1 ) ? false:true;
		}

		function edit_module_user($id_user, $id_module, $site, $data){
			$this->db->where('id_user', $this->pregRepn($id_user));
			$this->db->where('id_module', $this->pregRepn($id_module));
			$this->db->where('site', $this->pregReps($site));
			$this->db->update('mst_user_module', $data);
			return ( $this->db->affected_rows() != 1 ) ? false:true;
		}

	    function sidemenu($id_user, $site){
	    	$datax = array('b.id_user' => $this->pregRepn($id_user), 'b.site' => $this->pregReps($site));
	    	$query = $this->db->select('b.id_module, c.alias, c.name as module_name, d.id as id_system')
	    		->from('mst_user a')
	    		->join('mst_user_module b', 'a.id = b.id_user AND b.status_active = 1', 'inner')
	    		->join('mst_system_module c', 'b.id_module = c.id AND c.status_active = 1 AND c.isDelete = 0', 'inner')
	    		->join('mst_system d', 'c.id_system = d.id AND d.status_active = 1', 'inner')
	    		->where($datax)
	    		->order_by('c.name ASC')
	    		->get()
	    		->result();
	    	return $query;
	    }

	    function get_access_rights($id_user, $site, $module){
	    	$datax = array('a.id_user' => $this->pregRepn($id_user), 'a.site' => $this->pregReps($site), 'b.name' => $this->pregReps($module));
	    	$query = $this->db->select('a.id_user, a.site, c.id_level, a.status_active, a.id_module, b.name as module_name, a.create, a.read, a.update, a.delete, a.export, a.import')
	    		->from('mst_user_module a')
	    		->join('mst_system_module b', 'a.id_module = b.id AND b.status_active = 1', 'inner')
	    		->join('mst_user c', 'a.id_user = c.id', 'inner')
	    		->where($datax)
	    		->get();
    		if($query->num_rows() > 0 ){
	            return $query->row();
	    	} else { return false; }
	    }

	    function get_change_password($id){
			$datax = array('id_user' => $this->pregRepn($id), 'logs' => 'Change Password');
			$query = $this->db->from('mst_user_log')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return 'false'; }
		}

		function get_site(){
			$datax = array('status_active' => 1);
	    	$query = $this->db->select('code')
	    		->from('mst_site')
	    		->where($datax)
	    		->get()
	    		->result_array();
	    	$data = array();
	    	for ($i=0; $i < count($query) ; $i++) { 
	    		$data[] = $query[$i]['code'];
	    	}
	    	return $data;
	    }

	    function get_module(){
	    	$datax = array('isDelete' => 0);
	    	$query = $this->db->select('id')
	    		->from('mst_system_module')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	    function check_module_user_exist($id_user, $id_module, $site){
			$datax = array('id_user' => $this->pregRepn($id_user), 'id_module' => $this->pregRepn($id_module), 'site' => $site);
			$query = $this->db->from('mst_user_module')
				->where($datax)
				->get();
			if($query->num_rows() > 0 )
	            return true; 
	    		return false;
		}

		function get_id_user_module($id_user, $id_module, $site){
			$datax = array('id_user' => $this->pregRepn($id_user), 'id_module' => $this->pregRepn($id_module), 'site' => $site);
			$query = $this->db->select('id')
				->from('mst_user_module')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
		}


	}
?>