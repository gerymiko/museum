<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_sekolah extends CI_Model {

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

	    function sekolah(){
	    	$datax = array('status_active' => 1);
	    	$query = $this->db->from('mom_sekolah')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	    function get_image($id){
	    	$datax = array('status_active' => 1, 'id_sekolah' => $this->pregRepn($id));
	    	$query = $this->db->select('image')
	    		->from('mom_sekolah')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	}
?>