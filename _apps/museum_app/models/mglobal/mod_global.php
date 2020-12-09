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

	}
?>