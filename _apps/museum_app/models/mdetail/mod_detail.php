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
	    	$datax = array('a.id_category' => $this->pregRepn($id_category), 'a.isDelete' => 0, 'b.isDelete' => 0);
	    	$query = $this->db->select('b.id_detail, a.id_category, a.name as category_name, b.name as detail_name, b.description, b.file, b.type, b.thumbnail, b.tanggal')
	    		->from('msm_category a')
	    		->join('msm_detail b', 'a.id_category = b.id_category AND b.status_active = 1 AND a.status_active = 1', 'left')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function submenu($id_category){
	    	$datax = array('b.id_category' => $this->pregRepn($id_category), 'a.isDelete' => 0, 'b.isDelete' => 0);
	    	$query = $this->db->select('a.id_menu, b.id_category, a.name as submenu_name, b.name as category_name')
	    		->from('msm_submenu a')
	    		->join('msm_category b', 'a.id_menu = b.id_menu AND a.status_active = 1 AND b.status_active = 1', 'inner')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function get_file($id_detail){
	    	$datax = array('b.id_detail' => $this->pregRepn($id_detail), 'a.isDelete' => 0, 'b.isDelete' => 0);
	    	$query = $this->db->select('b.id_detail, a.id_category, b.file, b.type, b.thumbnail')
	    		->from('msm_category a')
	    		->join('msm_detail b', 'a.id_category = b.id_category AND b.status_active = 1 AND a.status_active = 1', 'left')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function get_thumbnail($id_detail){
	    	$datax = array('b.id_detail' => $this->pregRepn($id_detail), 'a.isDelete' => 0, 'b.isDelete' => 0);
	    	$query = $this->db->select('b.id_detail, a.id_category, b.file, b.type, b.thumbnail')
	    		->from('msm_category a')
	    		->join('msm_detail b', 'a.id_category = b.id_category AND b.status_active = 1 AND a.status_active = 1', 'left')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function detail_category($id_category){
	    	$datax = array('a.id_category' => $this->pregRepn($id_category), 'a.isDelete' => 0, 'b.isDelete' => 0);
	    	$query = $this->db->select('b.id_detail, a.id_category, a.name as category_name, b.name as detail_name, b.description, b.file, b.type, b.thumbnail, b.tanggal')
	    		->from('msm_category a')
	    		->join('msm_detail b', 'a.id_category = b.id_category AND b.status_active = 1 AND a.status_active = 1', 'left')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	}
?>