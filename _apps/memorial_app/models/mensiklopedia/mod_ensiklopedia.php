<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_ensiklopedia extends CI_Model {

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

	    function detail_ensiklopedia($id_menu){
	    	$datax = array('a.id_menu' => $id_menu);
	    	$query = $this->db->select('b.id_ensiklo, a.id_menu, b.name, a.name as submenu_name, b.tanggal, b.description, b.thumbnail, b.file, b.status_active, b.type')
	    		->from('mom_submenu a')
	    		->join('mom_ensiklopedia b', 'a.id_menu = b.id_menu AND b.isDelete = 0', 'inner')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	    function get_file($id_ensiklo){
	    	$datax = array('b.id_ensiklo' => $this->pregRepn($id_ensiklo), 'a.isDelete' => 0);
	    	$query = $this->db->select('b.file, b.type')
	    		->from('mom_submenu a')
	    		->join('mom_ensiklopedia b', 'a.id_menu = b.id_menu AND b.isDelete = 0', 'inner')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function get_thumbnail($id_ensiklo){
	    	$datax = array('b.id_ensiklo' => $this->pregRepn($id_ensiklo), 'a.isDelete' => 0);
	    	$query = $this->db->select('b.thumbnail, b.type')
	    		->from('mom_submenu a')
	    		->join('mom_ensiklopedia b', 'a.id_menu = b.id_menu AND b.isDelete = 0', 'inner')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function detail($id_menu){
	    	$datax = array('a.id_menu' => $id_menu);
	    	$query = $this->db->select('a.id_menu, a.id_sekolah, a.name as submenu_name')
	    		->from('mom_submenu a')
	    		->join('mom_ensiklopedia b', 'a.id_menu = b.id_menu AND b.isDelete = 0 AND b.status_active = 1', 'inner')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	}
?>