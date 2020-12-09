<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_about extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    function about(){
	    	$arraydata = array('1', '2');
	    	$datax = array('status_active' => 1);
	    	$query = $this->db->from('master_about')
	    		->where($datax)
	    		->where_in('id',$arraydata)
	    		->get()
	    		->result();
	    	return $query;
	    }
	}
?>