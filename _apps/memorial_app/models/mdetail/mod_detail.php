<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_detail extends CI_Model {

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

	    function detail($id_category){
	    	$datax = array('a.id_category' => $this->pregRepn($id_category), 'a.isDelete' => 0, 'a.status_active' => 1);
	    	$query = $this->db->select('a.id_category, a.name as category_name, a.id_alumni')
	    		->from('mom_alumni_category a')
	    		->join('mom_alumni_detail b', 'a.id_category = b.id_category AND b.status_active = 1 AND AND b.isDelete = 0', 'left')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function detail_list($id_category){
	    	$datax = array('a.id_category' => $this->pregRepn($id_category), 'a.isDelete' => 0, 'a.status_active' => 1);
	    	$query = $this->db->select('a.id_category, a.id_alumni, a.name as category_name, b.id_detail, b.name as detail_name, b.description, b.type, b.thumbnail, b.file, b.type')
	    		->from('mom_alumni_category a')
	    		->join('mom_alumni_detail b', 'a.id_category = b.id_category AND b.status_active = 1 AND b.isDelete = 0', 'inner')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	    function get_file($id_detail){
	    	$datax = array('b.id_detail' => $this->pregRepn($id_detail), 'a.isDelete' => 0, 'b.isDelete' => 0);
	    	$query = $this->db->select('b.id_detail, b.file, b.type, b.thumbnail')
	    		->from('mom_alumni_category a')
	    		->join('mom_alumni_detail b', 'a.id_category = b.id_category AND b.status_active = 1 AND a.status_active = 1', 'inner')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function get_thumbnail($id_detail){
	    	$datax = array('b.id_detail' => $this->pregRepn($id_detail), 'a.isDelete' => 0, 'b.isDelete' => 0);
	    	$query = $this->db->select('b.id_detail, b.file, b.type, b.thumbnail')
	    		->from('mom_alumni_category a')
	    		->join('mom_alumni_detail b', 'a.id_category = b.id_category AND b.status_active = 1 AND a.status_active = 1', 'inner')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	}
?>