<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_school extends CI_Model {

		var $col_order  = array(null, 'name', 'description', 'status_active');
		var $col_search = array('name'); 
		var $order      = array('id_sekolah' => 'ASC');

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

	    private function _get_school(){
	    	$this->db->select('id_sekolah, name, description,image, status_active');
	        $this->db->from('mom_sekolah');
	        $i = 0;
	        foreach ($this->col_search as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order)){
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_school($length, $start){
	        $this->_get_school();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_school(){
	        $this->_get_school();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_school(){
	    	$this->_get_school();
	    	return $this->db->count_all_results();
	    }

	    function get_image($id_sekolah){
	    	$datax = array('id_sekolah' => $this->pregRepn($id_sekolah));
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